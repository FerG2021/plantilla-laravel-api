<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VistaPrevision;
use App\Models\Producto;
use App\Models\Rubro;


class VistaPrevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $productosVistaPrevisionDB = VistaPrevision::orderBy('producto_nombre', 'asc')->get();

        $listaDevolverr = collect();

        foreach ($productosVistaPrevisionDB as $item) {
            $productoDB = Producto::find($item->producto_id);
            $productoDevolver = $productoDB->obtenerObjDatos();

            $rubroDB = Rubro::find($productoDB->rubro_id);
            $rubroDevoler = $rubroDB->obtenerObjDatos();

            $objDevolver = [
                'prevision_id' => $item->prevision_id,
                'plan_id' => $item->plan_id,
                'producto_id' => $item->producto_id,
                'prevision_periodo' => $item->prevision_periodo,
                'producto_nombre' => $item->producto_nombre,
                'producto_codigo' => $item->producto_codigo,
                'producto_puc' => $item->producto_puc,
                'producto_fpuc' => $item->producto_fpuc,
                'producto_unidad' => $item->producto_unidad,
                'prevision_unidad' => $item->prevision_unidad,
                'prevision_cantidad' => $item->prevision_cantidad,
                'rubro_nombre' => $item->rubro_nombre,
                'producto' => $productoDevolver,
                'rubro' => $rubroDevoler
            ];

            $listaDevolverr->push($objDevolver);
        }

        return $listaDevolverr;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getDatos($id)
    // {
    //     $productosVistaPrevisionDB = VistaPrevision::where('plan_id', '=', $id)->get();

    //     return $productosVistaPrevisionDB;
    // }


    
    // FUNCION QUE ESTABA ANTERIORMENTE, TRAE LOS PRODUCTOS SEGUN EL RUBRO Y LAS FECHAS SELECCIONADAS PARA LA PROVSION
    public function getDatos(Request $request)
    {
        $arrayBuscarProductosEnPrevision = json_decode($request->arrayBuscarProductosEnPrevision);

        $listaDevolver = collect();

        // primero voy a comparar si las dos fechas que mando son iguales
        if (
            $arrayBuscarProductosEnPrevision[0]->fechaDesdePresupuestacion ==   $arrayBuscarProductosEnPrevision[0]->fechaHastaPresupuestacion
            ) 
        {
            $productosVistaPrevisionDB = VistaPrevision::
                where('plan_id', '=', $arrayBuscarProductosEnPrevision[0]->plan_id)
                ->where('prevision_periodo', '=', date("Y-m-d", strtotime($arrayBuscarProductosEnPrevision[0]->fechaDesdePresupuestacion)))
                ->orderBy('producto_nombre', 'asc')
                ->get();
        } else {
            $productosVistaPrevisionDB = VistaPrevision::
                where('plan_id', '=', $arrayBuscarProductosEnPrevision[0]->plan_id)
                ->where('prevision_periodo', '>=',  date("Y-m-d", strtotime($arrayBuscarProductosEnPrevision[0]->fechaDesdePresupuestacion)))
                ->where('prevision_periodo', '<=', date("Y-m-d", strtotime($arrayBuscarProductosEnPrevision[0]->fechaHastaPresupuestacion)))
                ->orderBy('producto_nombre', 'asc')
                ->get();

            // $productosVistaPrevisionDB = VistaPrevision::
            //     where('plan_id', '=', $arrayBuscarProductosEnPrevision[0]->plan_id)
            //     ->where('prevision_periodo', '>=', $arrayBuscarProductosEnPrevision[0]->fechaDesdePresupuestacion)
            //     ->where('prevision_periodo', '<=', $arrayBuscarProductosEnPrevision[0]->fechaHastaPresupuestacion)
            //     ->orderBy('producto_nombre', 'asc')
            //     ->get();
        }

        foreach ($productosVistaPrevisionDB as $item) {
            $productoDB = Producto::find($item->producto_id);
            $productoDevolver = $productoDB->obtenerObjDatos();

            $rubroDB = Rubro::find($productoDB->rubro_id);
            $rubroDevoler = $rubroDB->obtenerObjDatos();

            $objDevolver = [
                'prevision_id' => $item->prevision_id,
                'plan_id' => $item->plan_id,
                'producto_id' => $item->producto_id,
                'prevision_periodo' => $item->prevision_periodo,
                'producto_nombre' => $item->producto_nombre,
                'producto_codigo' => $item->producto_codigo,
                'producto_puc' => $item->producto_puc,
                'producto_fpuc' => $item->producto_fpuc,
                'producto_unidad' => $item->producto_unidad,
                'prevision_unidad' => $item->prevision_unidad,
                'prevision_cantidad' => $item->prevision_cantidad,
                'rubro_nombre' => $item->rubro_nombre,
                'producto' => $productoDevolver,
                'rubro' => $rubroDevoler
            ];

            $listaDevolver->push($objDevolver);
        }

        return $listaDevolver;
        // return $productosVistaPrevisionDB;

    }

    // public function getDatos(Request $request){
    //     $productoDB = Producto::all();

    //     $listaDevolver = collect();

    //     foreach ($productoDB as $itemProducto) {
    //         $rubroDB = Rubro::where('rubro_id', '=', $itemProducto->rubro_id)->first();

    //         $objDevolver = [
    //             'producto' => $itemProducto,
    //             'rubro' => $rubroDB,
    //         ];

    //         $listaDevolver->push($objDevolver);
    //     }        

    //     return $listaDevolver;
    // }

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
