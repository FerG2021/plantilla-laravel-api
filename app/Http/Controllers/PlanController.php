<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Helpers\APIHelpers;
use Validator;


class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $planes = Plan::orderBy('plan_nombre', 'asc')->get();

        return $planes;
    }

    public function getTodosSelect(){
        $planes = Plan::select('plan_id', 'plan_nombre')
            ->orderBy('plan_nombre', 'ASC')
            ->get();
        
        return $planes;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDatos($id)
    {
        $planBD = Plan::find($id);

        if ($planBD) {
            $planDevolver = $planBD->obtenerObjDatos();

            $listaDevolver = [
                'plan_id' => $planBD->plan_id,
                'plan_activo' => $planBD->plan_activo,
                'plan_nombre' => $planBD->plan_nombre,
                'plan_fdesde' => $planBD->plan_fdesde,
                'plan_fhasta' => $planBD->plan_fhasta,
                'plan_plazo' => $planBD->plan_plazo,
                'cliente_id' => $planBD->cliente_id,
                'deposito_id' => $planBD->deposito_id,
                'transaccion_id' => $planBD->transaccion_id
            ];

            return $planDevolver;
        } else {
            return 0;
        }
        
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
