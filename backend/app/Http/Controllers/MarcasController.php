<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcasController extends Controller
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
    public function registrarMarcas (Request $request)
    {
        try {
            $nombre_marca = strtoupper ($request ->input('nombre_marca'));
            $validar = Marcas::where('nombre_marca', $nombre_marca)->count();
            if ($validar) {
               return [
                "ok"    => false,
                "validar"  => 'Lo sentimos ya existe una marca con el nombre de '
               ];

             } else {

                $registrarMarca = new Marcas();
                $registrarMarca->nombre_marca  =  $nombre_marca;
                $registrarMarca->save();
                return response () ->json([
                    "ok"    => true,
                    "data"  => $registrarMarca,
                    "aprovado" => 'Se guardo satisfactoriamente'

                ]);
            }

        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "data" => $ex->getMessage(),
                "error" => 'Hubo un error consulte con el administrador del sistema.'
           ]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marcas  $marcas
     * @return \Illuminate\Http\Response
     */
    public function mostrarMarcas()
    {
        $mostrarListaMarcas = DB::table('inv_marcas as marc')
        ->select('marc.id_marca','marc.nombre_marca')
        ->get();
        return response()->json([
            "ok"    =>true,
            "data"  =>$mostrarListaMarcas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marcas  $marcas
     * @return \Illuminate\Http\Response
     */
    public function editarMarcas(Request $request)
    {
        $id_marca = $request->input('id_marca');
        $data['nombre_marca'] = strtoupper($request->input('nombre_marca'));
        $verificar = Marcas::where('nombre_marca', $data['nombre_marca'])->count();

        if ($verificar) {
            return [
                "ok" => false,
                "verificar" => 'Lo sentimos ya existe una marca con el nombre de '
            ];
        }

        try {
            $modificarMarca = Marcas::where('id_marca', $id_marca)->update($data);
            return response()->json([
                "ok" =>true,
                "data" =>$modificarMarca,
                "modificado" => 'Se guardo satisfactoriamente'
            ]);
        } catch (\Exception $errorModificarMarca) {
            return response()->json([
                "ok" =>false,
                "data" =>$errorModificarMarca->getMessage(),
                "error" => 'Hubo un error consulte con el administrador de sistema.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marcas  $marcas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marcas $marcas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marcas  $marcas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marcas $marcas)
    {
        //
    }
}
