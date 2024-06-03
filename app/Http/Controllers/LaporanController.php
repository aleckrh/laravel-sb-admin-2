<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

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

        $request->validate([
            'foto.*'    => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
            'file'      => 'required'
        ]);

        $fileUpload = $request->file('file');
        $fileName = time().'_'.$fileUpload->getClientOriginalName();
        $fileUpload->move(public_path('file'),$fileName);


        foreach($request->foto as $value){
            $imageName = time().'_'.$value->getClientOriginalName();
            $value->move(public_path('gambar'),$imageName);

            $imagesNames[] = $imageName;
        }

        $storeLaporan = new Laporan([
            'user_id'       => auth()->user()->id,
            'judul'         => $request->judul,
            'ringkasan'     => $request->ringkasan,
            'file'          => $fileName,
            'foto'          => $imageName
        ]);

        // dd($request->all());


        $storeLaporan->save();

        return redirect('laporan/');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
