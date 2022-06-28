<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepositoArticulo;
use App\Models\Deposito;
use App\Helpers\APIHelpers;
use Validator;

class DepositoArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDatos($id)
    {
        // $depositoArticulo = DepositoArticulo::where('producto_id','=',$id)->get();

        // return $depositoArticulo;

        $depositoArticuloBD = DepositoArticulo::where('producto_id','=',$id)->get();
        $listaDevolver = collect();
        
        foreach ($depositoArticuloBD as $item) {
            $depositoDB = Deposito::find($item->deposito_id);
            $depositoDevolver = $depositoDB->obtenerObjDatos();

            $objDevolver = [
                'deposito_producto_id' => $item->deposito_producto_id,
                'deposito_id' => $item->deposito_id,
                'producto_id' => $item->producto_id,
                'producto_nombre' => $item->producto_nombre,
                'producto_stock' => $item->producto_stock,
                'producto_unidad' => $item->producto_unidad,
                'producto_activo' => $item->producto_activo,
                'rubro_id' => $item->rubro_id,
                'deposito' => $depositoDevolver,
            ];
            
            $listaDevolver->push($objDevolver);

        }

        return $listaDevolver;
        

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
