<?php

namespace App\Http\Controllers;

use App\Models\Pallet;
use Illuminate\Http\Request;

/**
 * Class PalletController
 * 
 * Esta clase es responsable de manejar las solicitudes relacionadas con el recurso Pallet.
 */
class PalletController extends Controller
{
    /**
     * Muestra una lista del recurso Pallet.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Aquí va el código para mostrar una lista del recurso Pallet
    }

    /**
     * Muestra el formulario para crear un nuevo recurso Pallet.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Aquí va el código para mostrar el formulario para crear un nuevo recurso Pallet
    }

    /**
     * Almacena un recurso Pallet recién creado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Aquí va el código para almacenar un recurso Pallet recién creado en el almacenamiento
    }

    /**
     * Muestra el recurso Pallet especificado.
     *
     * @param  \App\Models\Pallet  $pallet
     * @return \Illuminate\Http\Response
     */
    public function show(Pallet $pallet)
    {
        // Aquí va el código para mostrar el recurso Pallet especificado
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\Pallet  $pallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pallet $pallet)
    {
        // Aquí va el código para mostrar el formulario para editar el recurso especificado
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pallet  $pallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pallet $pallet)
    {
        // Aquí va el código para actualizar el recurso especificado en el almacenamiento
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param  \App\Models\Pallet  $pallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pallet $pallet)
    {
        // Aquí va el código para eliminar el recurso especificado del almacenamiento
    }
}
