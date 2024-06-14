<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\DivisiTerkait;
use App\Models\Foto;
use App\Models\Laporan;
use App\Models\Pelabuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Telegram\Bot\Laravel\Facades\Telegram;


class LaporanController extends Controller
{

    public function index()
    {
        try {
            $dataLaporan = Laporan::all();
            return view('admin.laporan.index', compact('dataLaporan'));
        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }
    }


    public function create()
    {
        try {
            $dataPelabuhan  = Pelabuhan::all();
            $dataDivisi     = Divisi::all();
            return view('admin.laporan.create',compact('dataPelabuhan','dataDivisi'));
        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }
    }


    public function store(Request $request)
    {
        try{        
            $request->validate([
                'judul'         => 'required',
                'deskripsi'     => 'required',
                'lokasi'        => 'required',
                'divisi'        => 'required|array|min:1',
                'divisi.*'      => 'string',
                'foto'          => 'nullable',
                'foto.*'        => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
                'file'          => 'nullable',
                'pelabuhan'     => 'required',
                'divisi'        => 'nullable|array'
            ],[
                'judul.required'        => 'Field judul harus diisi',
                'deskripsi.required'    => 'Field deskripsi harus diisi',
                'lokasi.required'       => 'Field lokasi harus diisi',
                'pelabuhan.required'    => 'Pilih salah satu Pelabuhan',
                'divisi.required'       => 'Pilih divisi yang dituju',
                'divisi.array'          => 'Pilih divisi yang dituju',
                'divisi.min'            => 'Pilih divisi yang dituju',
                ]
            );

            $storeLaporan               = new Laporan;
            $storeLaporan->user_id      = auth()->user()->id;
            $storeLaporan->judul        = $request->judul;
            $storeLaporan->deskripsi    = $request->deskripsi;
            $storeLaporan->pelabuhan    = $request->pelabuhan;
            $storeLaporan->lokasi       = $request->lokasi;
            $storeLaporan->status       = $request->status;


            if($request->hasFile('file')){
                $fileUpload = $request->file('file');
                $fileName = time() . '_' . $fileUpload->getClientOriginalName();
                $fileUpload->move(public_path('file'), $fileName);
                $storeLaporan->file = $fileName;
            }

            $storeLaporan->save();

            $checkBoxDivisi = $request->input('divisi',[]);
            foreach($checkBoxDivisi as $divisi){
                $divisiTerkait = new DivisiTerkait;
                $divisiTerkait->laporan_id  = $storeLaporan->id;
                $divisiTerkait->nama_divisi = $divisi; 
                $divisiTerkait->save();
            }

            if ($request->hasFile("foto")) {
                $files = $request->file("foto");
                foreach ($files as $file) {
                    $imageName      = time() . '_' . $file->getClientOriginalName();
                    $uploadFoto     = new Foto([
                        'laporan_id'    => $storeLaporan->id,
                        'foto'          => $imageName
                    ]);
                    $file->move(public_path('gambar'), $imageName);
                    $uploadFoto->save();
                }
            }

            try {
                $groupChat = -4243954575;
                $url = action([LaporanController::class,'show'],$storeLaporan->id);
                $message = "Judul Laporan = $request->judul\nLokasi = $request->lokasi \nPelapor = ".auth()->user()->name.' '.auth()->user()->last_name."\n$url";
                Telegram::sendMessage([
                    'chat_id'   =>  $groupChat,
                    'text'      => $message
                ]);

                Alert::toast('Laporan Terkirim !','success');
                return redirect('laporan/');

            } catch (\Throwable $th) {
                Log::error($th);
                $th->getMessage();
                Alert::toast('Tidak dapat mengirim Telegram, Periksa koneksi internet','warning');
                return redirect('laporan/');
            }

        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }
    }


    public function edit(string $id)
    {
        try {
            $dataPelabuhan  = Pelabuhan::all();
            $dataDivisi     = Divisi::all();
            $dataLaporan    = Laporan::find($id);
            return view('admin.laporan.edit', compact('dataLaporan'));    
        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }   
    }


    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'foto'      => 'required',
                'foto.*'    => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
                'file'      => 'required'
            ]);
    
            $dataLaporan = Laporan::findOrFail($id);
    
            if (File::exists('file/' . $dataLaporan->file)) {
                File::delete('file/' . $dataLaporan->file);
    
                $fileUpload = $request->file('file');
                $fileName = time() . '_' . $fileUpload->getClientOriginalName();
                $fileUpload->move(public_path('file'), $fileName);
    
                $dataLaporan->file          = $fileName;
                $dataLaporan->user_id       = $dataLaporan->user_id;
                $dataLaporan->judul         = $request->judul;
                $dataLaporan->lokasi        = $request->lokasi;
                $dataLaporan->deskripsi     = $request->deskripsi;
            }
    
            foreach ($dataLaporan->foto as $foto) {
                if (File::exists('gambar/' . $foto->foto)) {
                    File::delete('gambar/' . $foto->foto);
                }
                $foto->delete();
            }
    
            if ($request->hasFile("foto")) {
                $files = $request->file("foto");
                foreach ($files as $file) {
                    $imageName      = time() . '_' . $file->getClientOriginalName();
                    $uploadFoto     = new Foto([
                        'laporan_id'    => $dataLaporan->id,
                        'foto'          => $imageName
                    ]);
                    $file->move(public_path('gambar'), $imageName);
                    $uploadFoto->save();
                }
            }
    
            $dataLaporan->update();
            Alert::toast('Data Diupdate !','success');
            return redirect('/laporan');

        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }
    }


    public function destroy($id)
    {
        try {
            $dataLaporan = Laporan::findOrFail($id);

            if (File::exists("file/" . $dataLaporan->file)) {
                File::delete("file/" . $dataLaporan->file);
            }

            foreach ($dataLaporan->foto as $foto) {
                if (File::exists('gambar/' . $foto->foto)) {
                    File::delete('gambar/' . $foto->foto);
                }
            }

            $dataLaporan->delete();
            return redirect('/laporan');

        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }
    }


    public function error()
    {
        return view('admin.error.view');
    }

    public function show($id)
    {   
        try {
            $dataLaporan = Laporan::findOrFail($id);
            $fotoLaporan = $dataLaporan->foto;
            return view('admin.laporan.view', compact('dataLaporan','fotoLaporan'));    
        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }
    }


    public function setuju(Request $request ,$id)
    {   
        try {
            $dataLaporan = Laporan::findOrFail($id);
            $dataLaporan->status = $request->status;
            $dataLaporan->update();
            
            Alert::toast('Laporan Disetujui !','success');
            return redirect('/laporan');
        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }
    }


    public function group($id)
    {
        try {
            $dataPelabuhan = Pelabuhan::all();
            $dataDivisi = Divisi::all();
            $dataLaporan = Laporan::find($id);
            $divisiTerkait = $dataLaporan->divisiTerkait->pluck('nama_divisi')->all();

            return view('admin.laporan.group',compact('dataPelabuhan','dataDivisi','dataLaporan','divisiTerkait'));
        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }
    }


    public function groupping(Request $request, $id){
        try {
            $dataLaporan = Laporan::findOrFail($id);
            $dataLaporan->save();
            DivisiTerkait::query()->where('laporan_id',$id)->delete();

            $checkBoxDivisi = $request->input('divisi',[]);
            foreach($checkBoxDivisi as $divisi){
                $divisiTerkait = new DivisiTerkait;
                $divisiTerkait->laporan_id  = $dataLaporan->id;
                $divisiTerkait->nama_divisi = $divisi; 
                $divisiTerkait->save();
            }
            return redirect('/laporan');
        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.error.view');
        }
    }
}
