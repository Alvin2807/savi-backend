<?php

namespace App\Http\Controllers;

use App\Models\Modelos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModelosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Modelos  $modelos
     * @return \Illuminate\Http\Response
     */
    public function mostrarModelo()
    {
        $mostrarModelos = DB::table('inv_modelos as modelo')
        ->join('inv_marcas as marca', 'marca.id_marca', 'modelo.fk_marca')
        ->select('modelo.id_modelo','marca.id_marca','marca.nombre_marca','modelo.nombre_modelo')
        ->get();
        return response()->json([
            "ok" =>true,
            "data" =>$mostrarModelos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modelos  $modelos
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelos $modelos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modelos  $modelos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelos $modelos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelos  $modelos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelos $modelos)
    {
        //
    }
}
