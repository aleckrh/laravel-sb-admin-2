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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataLaporan = Laporan::all();

        return view('admin.laporan.index', compact('dataLaporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataPelabuhan  = Pelabuhan::all();
        $dataDivisi     = Divisi::all();
        return view('admin.laporan.create',compact('dataPelabuhan','dataDivisi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // try {

            
            $request->validate([
                'foto'          => 'nullable',
                'foto.*'        => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
                'file'          => 'nullable',
                'pelabuhan'     => 'required',
                'divisi'        => 'nullable|array'
            ]);

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

            // dd($request->all());

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

            $url = action([LaporanController::class,'show'],$storeLaporan->id);
            $message = "Judul Laporan = $request->judul\nLokasi = $request->lokasi \nPelapor = ".auth()->user()->name.' '.auth()->user()->last_name."\n $url";
            Telegram::sendMessage([
                'chat_id'   => -4253643491,
                'text'      => $message  
            ]);


            Alert::toast('Laporan Terkirim !','success');
            return redirect('laporan/');
            

        // } catch (\Throwable $th) {
        //     Log::error($th);
        //     $th->getMessage();
        //     return view('admin.error.view', compact('th'));
        // }
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataLaporan = Laporan::find($id);
        return view('admin.laporan.edit', compact('dataLaporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'foto'      => 'required',
            'foto.*'    => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
            'file'      => 'required'
        ]);



        $dataLaporan = Laporan::findOrFail($id);


        if (File::exists('file/' . $dataLaporan->file)) {
            File::delete('file/' . $dataLaporan->file);

            // $request->file('file')->move(public_path('file'), time() . '_' .$request->file('file')->getClientOriginalName()); 
            // $dataLaporan->file          = time() . '_' .$request->file('file')->getClientOriginalName();

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

        // dd($dataLaporan->foto);



        $dataLaporan->update();


        Alert::toast('Data Diupdate !','success');
        return redirect('/laporan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
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
    }

    public function error()
    {
        return view('admin.error.view');
    }

    public function show($id)
    {
        $dataLaporan = Laporan::findOrFail($id);
        $fotoLaporan = $dataLaporan->foto;
        
        return view('admin.laporan.view', compact('dataLaporan','fotoLaporan'));
    }

    public function setuju(Request $request ,$id)
    {
        $dataLaporan = Laporan::findOrFail($id);
        $dataLaporan->status = $request->status;

        $dataLaporan->update();
        
        Alert::toast('Laporan Disetujui !','success');
        return redirect('/laporan');
    }

}
