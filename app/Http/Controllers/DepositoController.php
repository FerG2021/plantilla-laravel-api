<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposito;


class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $depositos = Depostio::orderBy('deposito_nombre', 'asc')->get();
        $listaDevolver = collect();


        foreach ($depositos as $item) {
            $objDevolver = [
                'producto_auto' => $item->producto_auto,
                'producto_id' => $item->producto_id,
                'producto_codigo' => $item->producto_codigo,
                'producto_nombre' => $item->producto_nombre,
                'producto_puc' => $item->producto_puc,
                'producto_fpuc' => $item->producto_fpuc,
                'producto_unidad' => $item->producto_unidad,
                'producto_activo' => $item->producto_activo,
                'rubro_id' => $item->rubro_id,
                'rubro' => $rubroDevolver,
            ];

            $listaDevolver->push($objDevolver);   
            
        }

        return $todoDevolver;

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
