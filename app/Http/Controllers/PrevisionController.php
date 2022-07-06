<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prevision;


class PrevisionController extends Controller
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
     * Show the form for creating a new resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCantidadAPresupuestar(Request $request){
        $arrCantidadAPresupuestar = json_decode($request->arrayDatosParaCantidadPresupestacion);


        $listaDevolver = collect();

        $cantidadesProducto = Prevision::where('prevision_periodo','>=', $arrCantidadAPresupuestar[0]->fechaDesdePresupuestacion )->where('prevision_periodo','<=', $arrCantidadAPresupuestar[0]->fechaHastaPresupuestacion)->where('producto_id', '=', $arrCantidadAPresupuestar[0]->producto_id)->where('plan_id', '=', $arrCantidadAPresupuestar[0]->plan_id)->get();

        // return $cantidadesProducto;


        $cantidadAEnviar = 0;

        foreach ($cantidadesProducto as $item) {
            $cantidadAEnviar = $cantidadAEnviar + $item->prevision_cantidad;
        }

        $objDevolver = [
            'datos' => $cantidadesProducto,
            'cantidadPresupuestar' => $cantidadAEnviar
        ];



        return $objDevolver;
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
