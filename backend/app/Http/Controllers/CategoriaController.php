<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
    public function registrarCategorias(Request $request)
    {

        try {
            $categoria = strtoupper($request->input('descripcion'));
            $validar = Categoria::where('descripcion',$categoria)->count();
            if ($validar) {
                return [
                    "ok" => false,
                    "validar" => 'Ya existe una categoría '.$categoria
                ];
            } else {
                $registrarCategoria = new Categoria();
                $registrarCategoria->descripcion = $categoria;
                $registrarCategoria->estado = 'Vigente';
                $registrarCategoria->save();
                return response()->json([
                 "ok" => true,
                 "data" =>$registrarCategoria,
                 "aprobado" => 'Se guardo satisfactoriamente'
                ]);
            }

        } catch (\Throwable $e) {
            return response()->json([
                "ok" =>false,
                "data" =>$e->getMessage(),
                "error" => 'Hubo un error consulte con el administrador de sistema.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function mostrarCategorias()
    {
        //Funcion de mostrar categorias
        $categorias = Categoria::select('inv_categorias.id_categoria','inv_categorias.descripcion',
        'inv_categorias.usuario_modifica','inv_categorias.estado')
        ->get();
        return response()->json([
            "ok"    =>true,
            "data"  =>$categorias
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function editarCategoria(Request $request)
    {
        $id_categoria = $request->input('id_categoria');
        $data['descripcion'] = strtoupper($request->input('descripcion'));
        $verificar = Categoria::where('descripcion',$data['descripcion'])->count();
        if ($verificar) {
            return [
                "ok" =>false,
                "verificar" => 'Ya existe una categoría '.$data['descripcion']
            ];
        }
        try {
            $modificarCategoria = Categoria::where('id_categoria',$id_categoria)->update($data);
            return response()->json([
                "ok" =>true,
                "data" =>$modificarCategoria,
                "modificado" =>'Se guardo satisfactoriamente'
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
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
