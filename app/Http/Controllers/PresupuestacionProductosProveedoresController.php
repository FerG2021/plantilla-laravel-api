<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\APIHelpers;
use App\Models\PresupuestacionProductosProveedores;
use App\Models\PresupuestacionProveedores;
use App\Models\Producto;
use App\Models\Comparativa;
use App\Models\BorradorComparativa;
use App\Models\BorradorComparativaProveedores;
use App\Models\BorradorComparativaProductosProveedores;


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

    // genero los borradores de la comparativa
    public function crearBorrador(Request $request)
    {
        $arrayDatosBorrador = json_decode($request->arrayDatosBorrador);

        // pregunto si hay un borrador creado para la presupuestacion_id
        $borradorComparativa = BorradorComparativa::where('borrador_comparativa_presupuestacion_id' , '=', $request->presupuestacion_id)->first();

        if ($borradorComparativa) {
            // existe un borrador generado, entonces actualizo los datos

            // recorro el array para obtener los datos
            foreach ($arrayDatosBorrador as $item) {
                // proveedores
                $proveedor = BorradorComparativaProveedores::where('presupuestacion_id', '=', $item->presupuestacion_id)
                ->where('proveedor_id', '=', $item->proveedor_id)->first();

                $proveedor->presupuestacion_proveedor_id = $item->presupuestacion_proveedor_id;


                $proveedor->presupuestacion_plan_id = $item->presupuestacion_plan_id;
                
                $proveedor->proveedor_nombre = $item->proveedor_nombre;
                
                $proveedor->proveedor_rubro_id = $item->proveedor_rubro_id;
                
                $proveedor->proveedor_mail = $item->proveedor_mail;
                
                $proveedor->proveedor_monto_totalPP = $item->proveedor_monto_totalPP;
                
                $proveedor->proveedor_monto_flete = $item->proveedor_monto_flete;
                
                $proveedor->proveedor_factura_A = $item->proveedor_factura_A;
                
                $proveedor->proveedor_monto_factura_A = $item->proveedor_monto_factura_A;
                
                $proveedor->proveedor_forma_de_pago = $item->proveedor_forma_de_pago;
                
                $proveedor->proveedor_monto_descuentos_bonificaciones = $item->proveedor_monto_descuentos_bonificaciones;
                
                $proveedor->proveedor_monto_total_homogeneo = $item->proveedor_monto_total_homogeneo;

                $proveedor->save();


                // productos
                foreach ($item->productos as $itemProducto) {
                    $productoBD = BorradorComparativaProductosProveedores::where('presupuestacion_id', '=', $itemProducto->presupuestacion_id)
                    ->where('proveedor_id', '=', $itemProducto->proveedor_id)->where('producto_id', '=', $itemProducto->producto_id)->first();

                    
                    $productoBD->presupuestacion_producto_id = $itemProducto->presupuestacion_producto_id;
                    
                    $productoBD->presupuestacion_plan_id = $itemProducto->presupuestacion_plan_id;
                    
                    $productoBD->presupuestacion_rubro_id = $itemProducto->presupuestacion_rubro_id;
                    
                    $productoBD->presupuestacion_rubro_nombre = $itemProducto->presupuestacion_rubro_nombre;
                    
                    $productoBD->proveedor_nombre = $itemProducto->proveedor_nombre;
                    
                    $productoBD->proveedor_mail = $itemProducto->proveedor_mail;
                    
                    $productoBD->producto_nombre = $itemProducto->producto_nombre;
                    
                    $productoBD->producto_cantidad_a_comprar = $itemProducto->producto_cantidad_a_comprar;
                    
                    $productoBD->factor = $itemProducto->factor;
                    
                    $productoBD->cantidad_proveedor = $itemProducto->cantidad_proveedor;
                    
                    $productoBD->precio_png = $itemProducto->precio_png;
                    
                    $productoBD->iva = $itemProducto->iva;
                    
                    $productoBD->total_iva = $itemProducto->totaliva;
                    
                    $productoBD->precio_pu = $itemProducto->precio_pu;
                    
                    $productoBD->precio_pp = $itemProducto->precio_pp;

                    $productoBD->save();
                }


            }

            $respuesta = APIHelpers::createAPIResponse(false, 200, 'Borrador modificado con exito', null);

            return $respuesta;
        } else {
            // no existe un borrador generado, entonces genero uno nuevo
            
            // guardo borrador comparativa
            $borradorComparativa = new BorradorComparativa();

            $borradorComparativa->borrador_comparativa_presupuestacion_id = $request->presupuestacion_id;

            $borradorComparativa->save();


            // guardo borrador comparativa proveedores
            $borradorComparativa = BorradorComparativa::orderBy('borrador_comparativa_id', 'desc')->first();

            foreach ($arrayDatosBorrador as $item) {
                $borradorComparativaProveedor = new BorradorComparativaProveedores();

                $borradorComparativaProveedor->borrador_comparativa_id = $borradorComparativa->borrador_comparativa_id;

                $borradorComparativaProveedor->presupuestacion_id = $item->presupuestacion_id;

                $borradorComparativaProveedor->presupuestacion_proveedor_id = $item->presupuestacion_proveedor_id;

                $borradorComparativaProveedor->presupuestacion_plan_id = $item->presupuestacion_plan_id;

                $borradorComparativaProveedor->proveedor_id = $item->proveedor_id;

                $borradorComparativaProveedor->proveedor_nombre = $item->proveedor_nombre;

                $borradorComparativaProveedor->proveedor_rubro_id = $item->proveedor_rubro_id;

                $borradorComparativaProveedor->proveedor_mail = $item->proveedor_mail;

                $borradorComparativaProveedor->proveedor_monto_totalPP = $item->proveedor_monto_totalPP;

                $borradorComparativaProveedor->proveedor_monto_flete = $item->proveedor_monto_flete;

                $borradorComparativaProveedor->proveedor_factura_A = $item->proveedor_factura_A;

                $borradorComparativaProveedor->proveedor_monto_factura_A = $item->proveedor_monto_factura_A;

                $borradorComparativaProveedor->proveedor_forma_de_pago = $item->proveedor_forma_de_pago;

                $borradorComparativaProveedor->proveedor_monto_descuentos_bonificaciones = $item->proveedor_monto_descuentos_bonificaciones;
                
                $borradorComparativaProveedor->proveedor_monto_total_homogeneo = $item->proveedor_monto_total_homogeneo;

                $borradorComparativaProveedor->save();


                foreach ($item->productos as $itemProducto) {
                    $borradorComparativaProductoProveedor = new BorradorComparativaProductosProveedores();

                    $borradorComparativaProductoProveedor->borrador_comparativa_id = $borradorComparativa->borrador_comparativa_id;

                    $borradorComparativaProductoProveedor->presupuestacion_producto_id = $itemProducto->presupuestacion_producto_id;

                    $borradorComparativaProductoProveedor->presupuestacion_id = $itemProducto->presupuestacion_id;

                    $borradorComparativaProductoProveedor->presupuestacion_plan_id = $itemProducto->presupuestacion_plan_id;

                    $borradorComparativaProductoProveedor->presupuestacion_rubro_id = $itemProducto->presupuestacion_rubro_id;

                    $borradorComparativaProductoProveedor->presupuestacion_rubro_nombre = $itemProducto->presupuestacion_rubro_nombre;

                    $borradorComparativaProductoProveedor->proveedor_id = $itemProducto->proveedor_id;

                    $borradorComparativaProductoProveedor->proveedor_nombre = $itemProducto->proveedor_nombre;

                    $borradorComparativaProductoProveedor->proveedor_mail = $itemProducto->proveedor_mail;

                    $borradorComparativaProductoProveedor->producto_id = $itemProducto->producto_id;

                    $borradorComparativaProductoProveedor->producto_nombre = $itemProducto->producto_nombre;

                    $borradorComparativaProductoProveedor->producto_cantidad_a_comprar = $itemProducto->producto_cantidad_a_comprar;

                    $borradorComparativaProductoProveedor->factor = $itemProducto->factor;

                    $borradorComparativaProductoProveedor->cantidad_proveedor = $itemProducto->cantidad_proveedor;

                    $borradorComparativaProductoProveedor->precio_png = $itemProducto->precio_png;

                    $borradorComparativaProductoProveedor->iva = $itemProducto->iva;

                    $borradorComparativaProductoProveedor->total_iva = $itemProducto->totaliva;

                    $borradorComparativaProductoProveedor->precio_pu = $itemProducto->precio_pu;

                    $borradorComparativaProductoProveedor->precio_pp = $itemProducto->precio_pp;

                    $borradorComparativaProductoProveedor->save();

                }

            }            

            $respuesta = APIHelpers::createAPIResponse(false, 200, 'Borrador creado con exito', null);

            return $respuesta;
        }

        
        
    }


    // funcion para conocer la condicion de la comparativa
    public function getCondicionComparativa($id){
        // TIPOS DE ESTADO
        // 200 = EXISTE UNA COMPARATIVA GENERADA (NO SE PUEDE EDITAR)
        // 201 = EXISTE UN BORRADOR (SE PUEDE EDITAR O TOMAR LOS DATOS ORIGINALES)
        // 202 = NO EXISTE BORRADOR (SE MUESTRAN LOS DATOS ORIGINALES)

        // 
        // pregunto si hay una comparativa generada
        $comparativa = Comparativa::where('comparativa_presupuestacion_id', '=', $id)->first();

        if ($comparativa != null) {
            // existe una comparativa generada
            $respuesta = APIHelpers::createAPIResponse(false, 200, 'Existe una comparativa generada para la presupuestacion en cuestion', $comparativa);

            return response()->json($respuesta, 200);
        } else {
            // no existe una comparativa generada, pregunto si hay generada un borrdor de la comparativa

            $borradorComparativa = BorradorComparativa::where('borrador_comparativa_presupuestacion_id', '=', $id)->first();


            if ($borradorComparativa != null) {
                // existe un borrador de comparativa generada

                $respuesta = APIHelpers::createAPIResponse(false, 201, 'Existe un borrador de comparativa generada para la presupuestacion en cuestion', $comparativa);

                return response()->json($respuesta, 200);
            } else {
                // no existe un borrador de comparativa generada, se deben mostrar los datos originales

                $respuesta = APIHelpers::createAPIResponse(false, 202, 'No existe un borrador de comparativa generada para la presupuestacion en cuestion', $comparativa);

                return response()->json($respuesta, 200);

            }
        }
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos(Request $request)
    {
        // logica al agregar los borradores de la comparativa
        // Primero - verifico si existe una comparativa guardada con presupuestacion_id igual al id que viene en $id. Si existe quiere decir que ya se generaron las ordenes de compra y los datos no se pueden volver a modificar

        // Segundo - si no existe una comparativa guardada con presupuestacion_id igual al id que viene en $id voy a verificar si en la tabla borrador_comparativas hay alguna guardada con ese id. Si existe quiere decir que los datos se van a poder seguir modificando

        // Tercero si no existe en ninguno de las dos tablas quiere decir que recien se comienza a hacer la comparativa y no se guardo ningun dato, por ende se traen los datos como se venian haciendo
        
        
        // 
        // pregunto si hay una comparativa generada
        // $comparativa = Comparativa::where('comparativa_presupuestacion_id', '=', $id)->first();

        // if ($comparativa != null) {
        //     // existe una comparativa generada
        //     $respuesta = APIHelpers::createAPIResponse(false, 200, 'Existe una comparativa generada para la presupuestacion en cuestion', $comparativa);

        //     return response()->json($respuesta, 200);
        // } else {
        //     // no existe una comparativa generada, pregunto si hay generada un borrdor de la comparativa

        //     $borradorComparativa = BorradorComparativa::where('borrador_comparativa_presupuestacion_id', '=', $id)->first();


        //     if ($borradorComparativa != null) {
        //         // existe un borrador de comparativa generada

        //         $respuesta = APIHelpers::createAPIResponse(false, 200, 'Existe un borrador de comparativa generada para la presupuestacion en cuestion', $comparativa);

        //         return response()->json($respuesta, 200);
        //     } else {
        //         // no existe un borrador de comparativa generada, se deben mostrar los datos originales

        //         $respuesta = APIHelpers::createAPIResponse(true, 400, 'No existe un borrador de comparativa generada para la presupuestacion en cuestion', $comparativa);

        //         return response()->json($respuesta, 200);

        //     }
        // }


        // 
        // en la funcion getDatos() en el front se envia un parametro datosBorrador, este sirve para que si viene con valor 1 quiere decir que se buscan los datos del borrador y si viene con valor 0 quiere decir que se buscan los datos originales, los que son cargados por el proveedor
        // 
        
        $datosBorrador = $request->datosBorrador;


        if ($request->datosBorrador == 0) {
            // se utilizan los datos originales
            $proveedores = PresupuestacionProveedores::where('presupuestacion_id', '=', $request->id)->get();

            $productoProveedor = PresupuestacionProductosProveedores::where('presupuestacion_id', '=', $request->id)->get();

            $listaDevolver = collect();
            
            foreach ($proveedores as $itemProveedor) {
                $productos = collect();

                foreach ($productoProveedor as $itemProducto) {
                    if ($itemProveedor->proveedor_id == $itemProducto->proveedor_id) {
                        $productos->push($itemProducto);
                    }
                }

                // busco los productos de la tabla de productos para agregar la unidad de medida
                $productosTodosDB = Producto::all();
                $productosCompleto = collect();

                foreach ($productosTodosDB as $itemProductosTodosDB) {
                    foreach ($productos as $itemProductos) {
                        if ($itemProductos->producto_id == $itemProductosTodosDB->producto_id) {
                            $productosCompleto->push($itemProductosTodosDB);
                        }
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
                    'proveedor_monto_factura_A' => $itemProveedor->proveedor_monto_factura_A,
                    'proveedor_forma_de_pago' => $itemProveedor->proveedor_forma_de_pago,
                    'proveedor_monto_descuentos_bonificaciones' => $itemProveedor->proveedor_monto_descuentos_bonificaciones,
                    'proveedor_monto_total_homogeneo' => $itemProveedor->proveedor_monto_total_homogeneo,
                    'productos' => $productos,
                    'productosDB' => $productosCompleto,
                ];

                $listaDevolver->push($objDevolver);
            }

            
            return $listaDevolver;
        } else {
            // se utilizan los datos del borrador
            $proveedores = BorradorComparativaProveedores::where('presupuestacion_id', '=', $request->id)->get();

            $productoProveedor = BorradorComparativaProductosProveedores::where('presupuestacion_id', '=', $request->id)->get();

            $listaDevolver = collect();
            
            foreach ($proveedores as $itemProveedor) {
                $productos = collect();

                foreach ($productoProveedor as $itemProducto) {
                    if ($itemProveedor->proveedor_id == $itemProducto->proveedor_id) {
                        $productos->push($itemProducto);
                    }
                }

                // busco los productos de la tabla de productos para agregar la unidad de medida
                $productosTodosDB = Producto::all();
                $productosCompleto = collect();

                foreach ($productosTodosDB as $itemProductosTodosDB) {
                    foreach ($productos as $itemProductos) {
                        if ($itemProductos->producto_id == $itemProductosTodosDB->producto_id) {
                            $productosCompleto->push($itemProductosTodosDB);
                        }
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
                    'proveedor_monto_factura_A' => $itemProveedor->proveedor_monto_factura_A,
                    'proveedor_forma_de_pago' => $itemProveedor->proveedor_forma_de_pago,
                    'proveedor_monto_descuentos_bonificaciones' => $itemProveedor->proveedor_monto_descuentos_bonificaciones,
                    'proveedor_monto_total_homogeneo' => $itemProveedor->proveedor_monto_total_homogeneo,
                    'productos' => $productos,
                    'productosDB' => $productosCompleto,
                ];

                $listaDevolver->push($objDevolver);
            }

            
            return $listaDevolver;
        }
        


        



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

    public function getTodosProveedores(Request $request)
    {  
        if ($request->datosBorrador == 0) {
            // se utilizan los datos originales
            $presupuestacionProveedores = PresupuestacionProveedores::where('presupuestacion_id', '=', $request->id)->get();
            return $presupuestacionProveedores;
        } else {
            $presupuestacionProveedores = BorradorComparativaProveedores::where('presupuestacion_id', '=', $request->id)->get();
            return $presupuestacionProveedores;
        }

       
       
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
