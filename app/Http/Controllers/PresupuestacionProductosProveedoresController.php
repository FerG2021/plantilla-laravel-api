<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PresupuestacionProductosProveedores;
use App\Models\PresupuestacionProveedores;



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

        // Actualizo la informacion de montos, forma de pago y bonificaciones del proveedor
        $presupuestacionProveedor = PresupuestacionProveedores::where('presupuestacion_id', '=', $request->idPresupuestacion)->where('proveedor_id', '=', $request->idProveedor)->first();

        $presupuestacionProveedor->proveedor_monto_totalPP = $request->totalPP;
        $presupuestacionProveedor->proveedor_monto_flete = $request->precioFlete;
        $presupuestacionProveedor->proveedor_factura_A = $request->facturaA;
        $presupuestacionProveedor->proveedor_monto_factura_A = $request->proveedor_monto_factura_A;
        $presupuestacionProveedor->proveedor_forma_de_pago = $request->condicionpago;
        // $presupuestacionProveedor->proveedor_dia_de_pago = $request->diaPago;
        $presupuestacionProveedor->proveedor_monto_descuentos_bonificaciones = $request->descuentosyBonificaciones;
        $presupuestacionProveedor->proveedor_monto_total_homogeneo = $request->totalHomogeneo;

        $presupuestacionProveedor->save();

        foreach ($arrProductosProveedores as $item) {
            $itemProducto = PresupuestacionProductosProveedores::where('presupuestacion_producto_id', '=', $item->presupuestacion_producto_id)->where('proveedor_id', '=', $item->proveedor_id)->first();
            
            if ($itemProducto == false) {
                // si la cantidad del proveedor es distinta de 0 agrego el producto
                // if ($item->producto_cantidad_proveedor != 0) {
                // if ($item->precio_png != 0) {

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
                    
                    $presupuestacionProductosProveedores->producto_cantidad_a_comprar = $item->producto_cantidad_a_comprar;

                    $presupuestacionProductosProveedores->factor = $item->factor;

                    $presupuestacionProductosProveedores->cantidad_proveedor = $item->cantidad_proveedor;


                    $presupuestacionProductosProveedores->precio_png = $item->precio_png;

                    $presupuestacionProductosProveedores->iva = $item->iva;

                    $presupuestacionProductosProveedores->total_iva = $item->total_iva;

                    $presupuestacionProductosProveedores->precio_pu = $item->precio_pu;

                    $presupuestacionProductosProveedores->precio_pp = $item->precio_pp;
                    
                    // $productoProveedor->producto_cantidad_proveedor = $item->producto_cantidad_proveedor;
                    
                    // $productoProveedor->producto_precio_proveedor = $item->producto_precio;
                    $presupuestacionProductosProveedores->save();
                // }

               
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
                
                $productoProveedor->producto_cantidad_a_comprar = $item->producto_cantidad_a_comprar;

                $productoProveedor->factor = $item->factor;

                $productoProveedor->cantidad_proveedor = $item->cantidad_proveedor;

                $productoProveedor->precio_png = $item->precio_png;

                $productoProveedor->iva = $item->iva;

                $productoProveedor->total_iva = $item->total_iva;

                $productoProveedor->precio_pu = $item->precio_pu;

                $productoProveedor->precio_pp = $item->precio_pp;
                
                // $productoProveedor->producto_cantidad_proveedor = $item->producto_cantidad_proveedor;
                
                // $productoProveedor->producto_precio_proveedor = $item->producto_precio;

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
        $proveedores = PresupuestacionProveedores::where('presupuestacion_id', '=', $id)->get();

        $productoProveedor = PresupuestacionProductosProveedores::where('presupuestacion_id', '=', $id)->get();

        $listaDevolver = collect();
        
        foreach ($proveedores as $itemProveedor) {
            $productos = collect();

            foreach ($productoProveedor as $itemProducto) {
                if ($itemProveedor->proveedor_id == $itemProducto->proveedor_id) {
                    $productos->push($itemProducto);
                }
            }


            // $listaProductosDevolver = collect();
            
            // foreach ($productoProveedor as $itemProducto) {
            //     if ($itemProveedor->proveedor_id == $itemProducto->proveedor_id) {
            //         $productoBD = Producto::find($itemProducto->producto_id);

            //         $productoDevolver = [
            //             'productoPresupuestacion' => $itemProducto,
            //             'producto' => $productoBD,
            //         ];

            //         $productos->push($productoDevolver);
            //     }
            // }

            $objDevolver = [
                'presupuestacion_proveedor_id' => $itemProveedor->presupuestacion_proveedor_id,
                'presupuestacion_id' => $itemProveedor->presupuestacion_id,
                'presupuestacion_plan_id' => $itemProveedor->presupuestacion_plan_id,
                'proveedor_id' => $itemProveedor->proveedor_id,
                'proveedor_nombre' => $itemProveedor->proveedor_nombre,
                'proveedor_rubro_id' => $itemProveedor->proveedor_rubro_id,
                'proveedor_mail' => $itemProveedor->proveedor_mail, 
                'proveedor_monto_totalPP' => $itemProveedor->proveedor_monto_totalPP,
                'proveedor_monto_flete' => $itemProveedor->proveedor_monto_flete,
                'proveedor_factura_A' => $itemProveedor->proveedor_factura_A,
                'proveedor_forma_de_pago' => $itemProveedor->proveedor_forma_de_pago,
                'proveedor_monto_descuentos_bonificaciones' => $itemProveedor->proveedor_monto_descuentos_bonificaciones,
                'proveedor_monto_total_homogeneo' => $itemProveedor->proveedor_monto_total_homogeneo,
                'productos' => $productos,
            ];

            $listaDevolver->push($objDevolver);
        }

        
        return $listaDevolver;



        // OTRA OPCION
        // foreach ($productoProveedor as $itemProducto) {
        //     $proveedores = collect();

        //     foreach ($proveedores as $itemProveedor) {
        //         if ($itemProveedor->proveedor_id == $itemProducto->proveedor_id) {
        //             $proveedores->push($itemProveedor);
        //         }
        //     }

        //     $objDevolver = [
        //         'presupuestacion_productos_proveedores_id' => $itemProducto->presupuestacion_productos_proveedores_id,
        //         'presupuestacion_producto_id' => $itemProducto->presupuestacion_producto_id,
        //         'presupuestacion_id' => $itemProducto->presupuestacion_id,
        //         'presupuestacion_plan_id' => $itemProducto->presupuestacion_plan_id,
        //         'presupuestacion_rubro_id' => $itemProducto->presupuestacion_rubro_id,
        //         'presupuestacion_rubro_nombre' => $itemProducto->presupuestacion_rubro_nombre,
        //         'proveedor_id' => $itemProducto->proveedor_id,
        //         'proveedor_nombre' => $itemProducto->proveedor_nombre,
        //         'proveedor_mail' => $itemProducto->proveedor_mail,
        //         'producto_id' => $itemProducto->producto_id,
        //         'producto_nombre' => $itemProducto->producto_nombre,
        //         'producto_cantidad_a_comprar' => $itemProducto->producto_cantidad_a_comprar,
        //         'precio_png' => $itemProducto->precio_png,
        //         'iva' => $itemProducto->iva,
        //         'precio_pu' => $itemProducto->precio_pu,
        //         'precio_pp' => $itemProducto->precio_pp,
        //         'proveedor' =>  $proveedores,
        //     ];

        //     $listaDevolver->push($objDevolver);

        // }

        // return $listaDevolver;
    }

    public function getTodosProveedores($id)
    {  
       $presupuestacionProveedores = PresupuestacionProveedores::where('presupuestacion_id', '=', $id)->get();

       return $presupuestacionProveedores;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodosDatos(Request $request)
    {
        $productoProveedor = PresupuestacionProductosProveedores::where('presupuestacion_id', '=', $request->idPresupuestacion)->get();

        $presupuestacionProveedorDB = PresupuestacionProveedores::where('presupuestacion_id', '=', $request->idPresupuestacion)->where('proveedor_id', '=', $request->idProveedor)->first();
        

        if ($productoProveedor) {
            $objDevolver = [
                'productoProveedor' => $productoProveedor,
                'presupuestacionProveedorDB' => $presupuestacionProveedorDB,
            ];
            return $objDevolver;
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
