<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(component_entry);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show(Component $component)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function edit(Component $component)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Component $component)
    {
        //
    }
    /**
     * Muestra el informe de movimientos detallado de un componente.
     * @param int  $idComponente
     */
    public function informeMovimientoDetallado($idComponente)
    {
        $componente = Componente::with(['receptions', 'withdrawals'])->find($idComponente);
    
        // Ahora puedes acceder a la información detallada
        return view('report', compact('componente'));
    }

    public function loadFromCsv(Request $request)
    {
        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);
        foreach ($rows as $row) {
            $row = array_combine($header, $row);
            Component::create([
                'id_component' => $row['id_component'],
                'name' => $row['name'],
                'description' => $row['description'],
                'quantity' => $row['quantity'],
                'location' => $row['location'],
                'user_id' => $row['user_id'],
            ]);
        }
        return redirect()->route('component.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function destroy(Component $component)
    {
        //
    }
}
