<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

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
        return view('admin.laporan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
                
            $request->validate([
                'foto'      => 'required',
                'foto.*'    => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
                'file'      => 'required'
            ]);
    
            $fileUpload = $request->file('file');
            $fileName = time().'_'.$fileUpload->getClientOriginalName();
            $fileUpload->move(public_path('file'),$fileName);
    
            $storeLaporan = new Laporan([
                'user_id'       => auth()->user()->id,
                'judul'         => $request->judul,
                'ringkasan'     => $request->ringkasan,
                'deskripsi'     => $request->deskripsi,
                'file'          => $fileName,
            ]);
    
            $storeLaporan->save();
            
    
            
            if($request->hasFile("foto")){
                $files=$request->file("foto");
                foreach($files as $file){
                    $imageName              = time().'_'.$file->getClientOriginalName();
                    $uploadFoto = new Foto([
                        
                        'laporan_id'    => $storeLaporan->id,
                        'foto'          => $imageName
                    ]);
                    
                    $file->move(public_path('gambar'),$imageName);
                    
                    $uploadFoto->save();
                }
                
            }
            return redirect('laporan/');

        } catch (\Throwable $th) {
            Log::error($th);
            $th->getMessage();
            return view('admin.view.error',compact('th'));
        }

       
    }

    public function show($id)
    {
        $dataLaporan = Laporan::findOrFail($id);
        return view('admin.laporan.view',compact('dataLaporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataLaporan = Laporan::find($id);
        return view('admin.laporan.edit',compact('dataLaporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $dataLaporan = Laporan::findOrFail($id);
        if(File::exists("file/".$dataLaporan->file)){
            File::delete("file/".$dataLaporan->file);
        }

        $fotoLaporan = $dataLaporan->foto;

        dd($fotoLaporan);

    }

    public function error(){
        return view('admin.error.view');
    }
}
