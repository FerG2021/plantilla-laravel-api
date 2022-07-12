<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PresupuestacionProductosProveedores;


class PresupuestacionProductosProveedoresController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        $arrProductosProveedores = json_decode($request->arrProductosProveedores);

        foreach ($arrProductosProveedores as $item) {
            $itemProducto = PresupuestacionProductosProveedores::where('presupuestacion_producto_id', '=', $item->presupuestacion_producto_id)->where('proveedor_id', '=', $item->proveedor_id)->first();
            
            if ($itemProducto == false) {
                // si la cantidad del proveedor es distinta de 0 agrego el producto
                if ($item->producto_cantidad_proveedor != 0) {
                    // si el id es 0 agrego el producto
                    $presupuestacionProductosProveedores = new PresupuestacionProductosProveedores();

                    $presupuestacionProductosProveedores->presupuestacion_plan_id = $item->presupuestacion_plan_id;

                    $presupuestacionProductosProveedores->presupuestacion_producto_id = $item->presupuestacion_producto_id;
                    
                    $presupuestacionProductosProveedores->presupuestacion_id = $item->presupuestacion_id;
                    
                    $presupuestacionProductosProveedores->presupuestacion_rubro_id = $item->presupuestacion_rubro_id;
                    
                    $presupuestacionProductosProveedores->presupuestacion_rubro_nombre = $item->presupuestacion_rubro_nombre;
                    
                    $presupuestacionProductosProveedores->proveedor_id = $item->proveedor_id;
                    
                    $presupuestacionProductosProveedores->proveedor_nombre = $item->proveedor_nombre;
                    
                    $presupuestacionProductosProveedores->proveedor_mail = $item->proveedor_mail;
                    
                    $presupuestacionProductosProveedores->producto_id = $item->producto_id;
                    
                    $presupuestacionProductosProveedores->producto_nombre = $item->producto_nombre;
                    
                    $presupuestacionProductosProveedores->producto_cantidad_a_comprar = $item->producto_cantidad_real_a_comprar;
                    
                    $presupuestacionProductosProveedores->producto_cantidad_proveedor = $item->producto_cantidad_proveedor;
                    
                    $presupuestacionProductosProveedores->producto_precio_proveedor = $item->producto_precio;

                    $presupuestacionProductosProveedores->save();
                }
            } else {
                $productoProveedor = PresupuestacionProductosProveedores::findOrFail($item->presupuestacion_productos_proveedores_id);


                $productoProveedor->presupuestacion_plan_id = $item->presupuestacion_plan_id;

                $productoProveedor->presupuestacion_producto_id = $item->presupuestacion_producto_id;
                
                $productoProveedor->presupuestacion_id = $item->presupuestacion_id;
                
                $productoProveedor->presupuestacion_rubro_id = $item->presupuestacion_rubro_id;
                
                $productoProveedor->presupuestacion_rubro_nombre = $item->presupuestacion_rubro_nombre;
                
                $productoProveedor->proveedor_id = $item->proveedor_id;
                
                $productoProveedor->proveedor_nombre = $item->proveedor_nombre;
                
                $productoProveedor->proveedor_mail = $item->proveedor_mail;
                
                $productoProveedor->producto_id = $item->producto_id;
                
                $productoProveedor->producto_nombre = $item->producto_nombre;
                
                $productoProveedor->producto_cantidad_a_comprar = $item->producto_cantidad_real_a_comprar;
                
                $productoProveedor->producto_cantidad_proveedor = $item->producto_cantidad_proveedor;
                
                $productoProveedor->producto_precio_proveedor = $item->producto_precio;

                $productoProveedor->save();

            }
        }

        return $itemProducto;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos($id)
    {
        $productoProveedor = PresupuestacionProductosProveedores::where('presupuestacion_id', '=', $id)->get();

        if ($productoProveedor) {
            return $productoProveedor;
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
