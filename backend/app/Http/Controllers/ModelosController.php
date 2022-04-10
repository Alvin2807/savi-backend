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
    public function registrarModelos(Request $request)
    {
        $id_marca = $request->input('id_marca');
        $item = $request->input('modelos');

        try {
          for ($i=0; $i <count($item) ; $i++) {
              $registrarModelo = new Modelos();
              $registrarModelo->fk_marca = $id_marca;
              $registrarModelo->nombre_modelo =  strtoupper( $item[$i]['nombre_modelo']);
              $registrarModelo->save();
              return response()->json([
                "ok" =>true,
                "data" =>$registrarModelo,
                "registroModelo" => 'Se guardo satisfactoriamente'
              ]);
          }
        } catch (\Exception $e) {
            return response()->json([
                "ok" =>false,
                "data" =>$e->getMessage(),
                "mensajeErrorModelo" => 'Hubo un error, consulte con el administrador del sistema.'
            ]);
        }
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
    public function editarModelos(Request $request)
    {
        $id_modelo = $request->input('id_modelo');
        $data['nombre_modelo'] = strtoupper($request->input('nombre_modelo'));
        $verificar = Modelos::where('nombre_modelo', $data['nombre_modelo'])->count();

        if ($verificar) {
            return [
                "ok" =>false,
                "verificar" => 'Ya existe un modelo '. $data['nombre_modelo']
            ];
        }
        try {
           $editarModelo = Modelos::where('id_modelo',$id_modelo)->update($data);
           return response()->json([
            "ok" =>true,
            "data" =>$editarModelo,
            "modificado" => 'Se guardo satisfactoriamente'
           ]);

        } catch (\Exception $e) {
            return response()->json([
                "ok" =>false,
                "data" =>$e->getMessage(),
                "error" => 'Hubo un error consulte con el administrador de sistema.'
            ]);
        }
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
