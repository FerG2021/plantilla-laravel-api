<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Http\Clases\Respuesta;
use App\Http\Controllers\EstadosGlobales;
use App\Http\Controllers\ExcepcionesGlobales;
use App\Http\Clases\Utils;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $categorias = Categoria::orderBy('created_at', 'desc')->get();
        

        return $categorias;
    }

    public function getTodosSelect(){
        $categorias = Categoria::select('id', 'nombre')
            ->orderBy('nombre', 'ASC')
            ->get();
        
        return $categorias;
    }


    public function getDatos($id)
    {        
        $categoriaDB = Categoria::find($id);

        if ($categoriaDB) {
            $categoriaDevolver = $categoriaDB->obtenerObjDatos();

            return $categoriaDevolver;
        } else {
            return 0;
        }       
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
    public function crear(Request $request)
    {
        $categoria = new Categoria();

        $categoria->nombre = $request->nombre;

        $categoria->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request)
    {
        $categoria = Categoria::findOrFail($request->id);

        $categoria->nombre = $request->nombre;

        $categoria->save();

        return $categoria;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request)
    {
        $categoria = Categoria::find($request->id);
        $categoria->delete();
        return $categoria;
    }
}
