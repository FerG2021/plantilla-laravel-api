<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Rubro;
use App\Http\Clases\Respuesta;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $productos = Producto::orderBy('producto_nombre', 'asc')->get();

        // return $productos;

        $listaDevolver = collect();
        $cantPorPag = 20;
        $nroPagina = 1;

        foreach ($productos as $item) {
            //rubro
            $rubroDB = Rubro::find($item->rubro_id);
            $rubroDevolver = $rubroDB->obtenerObjDatos();

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
            
            //Datos de paginado
            $pagTotalItems = $listaDevolver->count();
            $pagTotal = ceil($pagTotalItems / $cantPorPag);
            $pagActual = $nroPagina;

            $listaPagDevoler = [
                'pagTotalItems' => $pagTotalItems,
                'pagTotal' => $pagTotal,
                'pagActual' => $pagActual
            ];

            
        }

        $todoDevolver = [
            'datos' => $listaDevolver,
            'pagina' => $listaPagDevoler,
        ];

        return $todoDevolver;
        // return $listaDevolver;
    }

    public function getDatos($id){
        $productoBD = Producto::where('producto_id','=',$id)->first(); 

        if ($productoBD) {
            //rubro
            $rubroDB = Rubro::find($productoBD->rubro_id);
            $rubroDevolver = $rubroDB->obtenerObjDatos();

            $objDevolver = [
                'producto_auto' => $productoBD->producto_auto,
                'producto_id' => $productoBD->producto_id,
                'producto_codigo' => $productoBD->producto_codigo,
                'producto_nombre' => $productoBD->producto_nombre,
                'producto_puc' => $productoBD->producto_puc,
                'producto_fpuc' => $productoBD->producto_fpuc,
                'producto_unidad' => $productoBD->producto_unidad,
                'producto_activo' => $productoBD->producto_activo,
                'rubro_id' => $productoBD->rubro_id,
                'rubro' => $rubroDevolver,
            ];

            return $objDevolver;
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
