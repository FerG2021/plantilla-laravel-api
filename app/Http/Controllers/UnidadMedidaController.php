<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadMedida;
use App\Http\Clases\Respuesta;
use App\Http\Controllers\EstadosGlobales;
use App\Http\Controllers\ExcepcionesGlobales;
use App\Http\Clases\Utils;

class UnidadMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $unidadMedidas = UnidadMedida::orderby('created_at', 'desc')->get();
        return $unidadMedidas;
    }

    public function getTodosSelect(){
        $unidadMedidas = UnidadMedida::select('id', 'nombre')
            ->orderBy('nombre', 'ASC')
            ->get();
        
        return $unidadMedidas;
    }

    public function getDatos($id)
    {        
        $unidadMedidaDB = UnidadMedida::find($id);

        if ($unidadMedidaDB) {
            $unidadMedidaDevolver = $unidadMedidaDB->obtenerObjDatos();

            return $unidadMedidaDevolver;
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
        $unidadMedida = new UnidadMedida();

        $unidadMedida->nombre = $request->nombre;

        $unidadMedida->save();
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
    public function actualizar(Request $request, $id)
    {
        $unidadMedida = UnidadMedida::findOrFail($request->id);

        $unidadMedida->nombre = $request->nombre;

        $unidadMedida->save();

        return $unidadMedida;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request)
    {
        $unidadMedida = UnidadMedida::find($request->id);
        $unidadMedida->delete();
        return $unidadMedida;
    }
}
