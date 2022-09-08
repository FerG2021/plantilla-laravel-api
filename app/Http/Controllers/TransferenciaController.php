<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transferencia;
use App\Models\Presupuestacion;
use App\Models\PresupuestacionProductos;
use App\Models\PresupuestacionProveedores;
use App\Models\Deposito;



class TransferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $transferenciasDB = Transferencia::orderBy('transferencia_id', 'desc')->where('transferencia_presupuestacion_id', '<>', null)->get();


        $listaDevolver = collect();
        $listaDevolverPresupuestacion = collect();

        foreach ($transferenciasDB as $itemTransferencia) {
            // obtengo los datos de cada una de las transferencias
            $transferencia = $itemTransferencia->obtenerObjDatos();

            $presupuestacionDB = Presupuestacion::where('presupuestacion_id', '=', $itemTransferencia->transferencia_presupuestacion_id)->first();

            $depositoDB = Deposito::where('deposito_id', '=', $itemTransferencia->transferencia_deposito_id)->first();


            $objDevolver = [
                'transferencia' => $transferencia,
                'presupuestacion' => $presupuestacionDB,
                'deposito' => $depositoDB,
            ];

            $listaDevolver->push($objDevolver);
        }

        return $listaDevolver;

        
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request){
        $transferencia = Transferencia::findOrFail($request->id);

        $transferencia->transferencia_estado = $request->estado;

        if ($transferencia->save()) {
            return $transferencia;
        }
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
