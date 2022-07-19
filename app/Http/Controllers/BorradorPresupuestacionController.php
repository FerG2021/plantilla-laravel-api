<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorradorPresupuestacion;
use App\Models\BorradorPresupuestacionProductos;
use App\Models\BorradorPresupuestacionProveedores;
use App\Models\BorradorPresupuestacionRubros;
use App\Models\Producto;
use App\Models\Rubro;
use App\Models\Plan;
use App\Models\Presupuestacion;
use App\Models\PresupuestacionProductos;
use App\Models\PresupuestacionProveedores;
use App\Mail\TestMail;
use Mail;


class BorradorPresupuestacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $presupuestacionBD = BorradorPresupuestacion::orderby('borrador_presupuestacion_id')->get();

        $listaDevolver = collect();

        foreach ($presupuestacionBD as $item) {
            $presupuestacionproductosDB = BorradorPresupuestacionProductos::where('borrador_presupuestacion_id', '=', $item->borrador_presupuestacion_id)->get();

            $presupuestacionproveedoresDB = BorradorPresupuestacionProveedores::where('borrador_presupuestacion_id', '=', $item->borrador_presupuestacion_id)->get();

            $presupuestacionrubrosDB = BorradorPresupuestacionRubros::where('borrador_presupuestacion_id', '=', $item->borrador_presupuestacion_id)->get();

            $objDevolver = [
                'borrador_presupuestacion_id' => $item->borrador_presupuestacion_id,
                'borrador_presupuestacion_plan_id' => $item->borrador_presupuestacion_plan_id,
                'borrador_presupuestacion_plan_nombre' => $item->borrador_presupuestacion_plan_nombre,
                'borrador_presupuestacion_fecha_incio' => $item->borrador_presupuestacion_fecha_incio,
                'borrador_presupuestacion_fecha_fin' => $item->borrador_presupuestacion_fecha_fin,
                'borrador_presupuestacion_fecha_creacion' => $item->created_at,
                'borrador_presupuestado' => $item->borrador_presupuestado,
                'productos' => $presupuestacionproductosDB,
                'proveedores' => $presupuestacionproveedoresDB,
                'rubros' => $presupuestacionrubrosDB,
            ];
            
            $listaDevolver->push($objDevolver);
        }

        return $listaDevolver;
    }

    public function getDatos($id){
        $presupuestacionBD = BorradorPresupuestacion::find($id);

        $presupuestacionDatosDB = Plan::find($presupuestacionBD->borrador_presupuestacion_plan_id);

        if ($presupuestacionBD) {
            // productos
            $listaProductosDevolver = collect();
            $productosDB = BorradorPresupuestacionProductos::where('borrador_presupuestacion_id', '=', $id)->get();

            foreach ($productosDB as $itemProductosDB) {
                $rubroDevolver = $itemProductosDB->obtenerObjDatos();

                $productoBD = Producto::find($itemProductosDB->borrador_producto_id);

                $productoDevolver = [
                    'productoPresupuestacion' => $rubroDevolver,
                    'producto' => $productoBD,
                ];

                $listaProductosDevolver->push($productoDevolver);
            }

            // proveedores
            $listaProveedoresDevolver = collect();
            $proveedoresDB = BorradorPresupuestacionProveedores::where('borrador_presupuestacion_id', '=', $id)->get();

            foreach ($proveedoresDB as $itemProveedores) {
                $proveedoresDevolver = $itemProveedores->obtenerObjDatos();
                
                $rubroDB = Rubro::find($itemProveedores->borrador_proveedor_rubro_id);

                $proveedorDevolver = [
                    'proveedor' => $proveedoresDevolver,
                    'rubro' => $rubroDB
                ];

                $listaProveedoresDevolver->push($proveedorDevolver);


            }
 
            $objDevolver = [
                'borrador_presupuestacion_id' => $presupuestacionBD->borrador_presupuestacion_id,
                'borrador_presupuestacion_plan_id' => $presupuestacionBD->borrador_presupuestacion_plan_id,
                'borrador_presupuestacion_plan_nombre' => $presupuestacionBD->borrador_presupuestacion_plan_nombre,
                'borrador_presupuestacion_plan_fecha_inicio' => $presupuestacionDatosDB->plan_fdesde,
                'borrador_presupuestacion_plan_fecha_fin' => $presupuestacionDatosDB->plan_fhasta,
                'borrador_presupuestacion_plan_plazo' => $presupuestacionDatosDB->plan_plazo,
                'borrador_presupuestacion_rubro_id' => $presupuestacionBD->borrador_presupuestacion_rubro_id,
                'borrador_presupuestacion_rubro_nombre' => $presupuestacionBD->borrador_presupuestacion_rubro_nombre,
                'borrador_presupuestacion_fecha_incio' => $presupuestacionBD->borrador_presupuestacion_fecha_incio,
                'borrador_presupuestacion_fecha_fin' => $presupuestacionBD->borrador_presupuestacion_fecha_fin,
                'borrador_presupuesto_fecha_creacion' => $presupuestacionBD->created_at,
                'productos' => $listaProductosDevolver,
                'proveedores' => $listaProveedoresDevolver,
            ];
        }

        return $objDevolver;
    }

    public function actualizar(Request $request){
        $borradorPresupuestacionBD = BorradorPresupuestacion::findOrFail($request->presupuestacion_id);

        $arrProductosRecibidos = json_decode($request->arrayProductosAComprarEnviar);

        $arrProveedoresRecibidos = json_decode($request->arrayProveedoresMostrarEnviar);

        if ($borradorPresupuestacionBD) {
            // elimino los productos viejos y agrego los nuevos
            // $productosEliminar = BorradorPresupuestacionProductos::where('borrador_presupuestacion_id', '=', $request->presupuestacion_id)->get();

            // foreach ($productosEliminar as $itemProductoEliminar) {
            //     $itemProductoEliminar = BorradorPresupuestacionProductos::where('borrador_presupuestacion_id', '=', $request->presupuestacion_id)->first();
            //     $itemProductoEliminar->delete();
            // }

            foreach ($arrProductosRecibidos as $itemProducto) {
                // borro los que tienen accion B
                if ($itemProducto->accion == "B") {
                    $productoEliminar = BorradorPresupuestacionProductos::find($itemProducto->borrador_presupuestacion_producto_id);

                    $productoEliminar->delete();

                    
                }



                if ($itemProducto->accion == "A") {
                    $presupuestacionproductos = new BorradorPresupuestacionProductos();

                    $presupuestacionproductos->borrador_presupuestacion_id = $request->presupuestacion_id;
                
                    $presupuestacionproductos->borrador_presupuestacion_plan_id = $request->presupuestacion_plan_id;

                    $presupuestacionproductos->borrador_producto_id = $itemProducto->producto_id;

                    $presupuestacionproductos->borrador_producto_nombre = $itemProducto->producto_nombre;

                    $presupuestacionproductos->borrador_producto_rubro_id = $itemProducto->producto_rubro_id;

                    $presupuestacionproductos->borrador_producto_rubro_nombre = $itemProducto->producto_rubro_nombre;

                    $presupuestacionproductos->borrador_producto_cantidad_a_comprar = $itemProducto->producto_cantidad_a_comprar;

                    $presupuestacionproductos->borrador_producto_cantidad_deposito = $itemProducto->producto_cantidad_deposito;

                    $presupuestacionproductos->borrador_producto_cantidad_real_a_comprar = $itemProducto->producto_cantidad_real_a_comprar;

                    $presupuestacionproductos->save();
                }
            }


            // elimino los proveedores viejos y agrego los nuevos
            $proveedoresEliminar = BorradorPresupuestacionProveedores::where('borrador_presupuestacion_id', '=', $request->presupuestacion_id)->get();

            foreach ($proveedoresEliminar as $itemProveedoresEliminar) {
                $itemProveedoresEliminar->delete();
            }

            foreach ($arrProveedoresRecibidos as $itemProveedor) {
               if ($itemProveedor->accion == "A") {
                    $presupuestacionproveedores = new BorradorPresupuestacionProveedores();

                    $presupuestacionproveedores->borrador_presupuestacion_id = $request->presupuestacion_id;
                        
                    $presupuestacionproveedores->borrador_presupuestacion_plan_id = $request->presupuestacion_plan_id;

                    $presupuestacionproveedores->borrador_proveedor_id = $itemProveedor->proveedor_id;

                    $presupuestacionproveedores->borrador_proveedor_nombre = $itemProveedor->proveedor_nombre;

                    $presupuestacionproveedores->borrador_proveedor_rubro_id = $itemProveedor->proveedor_rubro_id;

                    $presupuestacionproveedores->borrador_proveedor_mail = $itemProveedor->proveedor_mail;

                    $presupuestacionproveedores->borrador_proveedor_monto_totalPP = 0; 
                    
                    $presupuestacionproveedores->borrador_proveedor_monto_flete = 0;
                    
                    $presupuestacionproveedores->borrador_proveedor_factura_A = 0;
                    
                    $presupuestacionproveedores->borrador_proveedor_forma_de_pago = 0;
                    
                    $presupuestacionproveedores->borrador_proveedor_monto_descuentos_bonificaciones = 0;
                    
                    $presupuestacionproveedores->borrador_proveedor_monto_total_homogeneo = 0;

                    $presupuestacionproveedores->save();
                }
            }

            

            return $request->presupuestacion_id;
        }
    }

    public function crearPesupuestacion(Request $request){
        $arrRubrosComprar = json_decode($request->arrayRubrosAComprar);
        
        foreach ($arrRubrosComprar as $itemRubro) {
            // primero guardo los datos de la presupuestacion
            $presupuestacion = new Presupuestacion();

            $presupuestacion->presupuestacion_plan_id = $request->presupuestacion_plan_id;

            $presupuestacion->presupuestacion_plan_nombre = $request->presupuestacion_plan_nombre;

            $presupuestacion->presupuestacion_rubro_id = $itemRubro->rubro_id;

            $presupuestacion->presupuestacion_rubro_nombre = $itemRubro->rubro_nombre;
            
            $presupuestacion->presupuestacion_fecha_incio = date('Y-m-d h:i:s', strtotime($request->presupuestacion_fecha_incio));

            $presupuestacion->presupuestacion_fecha_fin = date('Y-m-d h:i:s', strtotime($request->presupuestacion_fecha_fin));
            
            $presupuestacion->save();



            // guardo los productos de la presupuestacion
            $presupuestacionBD = Presupuestacion::orderBy('presupuestacion_id', 'desc')->first();

            $arrProductos = json_decode($request->arrayProductosAComprarEnviar);


            foreach ($arrProductos as $itemProducto) {
                if ($itemProducto->accion == "A") {
                    if ($itemProducto->producto_rubro_id == $itemRubro->rubro_id) {
                        $presupuestacionproductos = new PresupuestacionProductos();
    
                        $presupuestacionproductos->presupuestacion_id = $presupuestacionBD->presupuestacion_id;
                
                        $presupuestacionproductos->presupuestacion_plan_id = $presupuestacionBD->presupuestacion_plan_id;
    
                        $presupuestacionproductos->producto_id = $itemProducto->producto_id;
    
                        $presupuestacionproductos->producto_nombre = $itemProducto->producto_nombre;
    
                        $presupuestacionproductos->producto_rubro_id = $itemProducto->producto_rubro_id;
    
                        $presupuestacionproductos->producto_rubro_nombre = $itemProducto->producto_rubro_nombre;
    
                        $presupuestacionproductos->producto_cantidad_a_comprar = $itemProducto->producto_cantidad_a_comprar;
    
                        $presupuestacionproductos->producto_cantidad_deposito = $itemProducto->producto_cantidad_deposito;
    
                        $presupuestacionproductos->producto_cantidad_real_a_comprar = $itemProducto->producto_cantidad_real_a_comprar;
    
                        $presupuestacionproductos->save();
    
                        
    
                    }
                }
            }



            // guardo los proveedores de la presupuestacion
            $arrProveedores = json_decode($request->arrayProveedoresMostrarEnviar);

            foreach ($arrProveedores as $itemProveedores) {
                if ($itemProveedores->accion == "A") {
                    if ($itemProveedores->proveedor_rubro_id == $itemRubro->rubro_id) {
                        $presupuestacionproveedores = new PresupuestacionProveedores();
    
                        $presupuestacionproveedores->presupuestacion_id = $presupuestacionBD->presupuestacion_id;
                        
                        $presupuestacionproveedores->presupuestacion_plan_id = $presupuestacionBD->presupuestacion_plan_id;
    
                        $presupuestacionproveedores->proveedor_id = $itemProveedores->proveedor_id;
    
                        $presupuestacionproveedores->proveedor_nombre = $itemProveedores->proveedor_nombre;
    
                        $presupuestacionproveedores->proveedor_rubro_id = $itemProveedores->proveedor_rubro_id;
    
                        $presupuestacionproveedores->proveedor_mail = $itemProveedores->proveedor_mail;
    
                        $presupuestacionproveedores->proveedor_monto_totalPP = 0; 
                        $presupuestacionproveedores->proveedor_monto_flete = 0;
                        $presupuestacionproveedores->proveedor_factura_A = 0;
                        $presupuestacionproveedores->proveedor_forma_de_pago = 0;
                        $presupuestacionproveedores->proveedor_monto_descuentos_bonificaciones = 0;
                        $presupuestacionproveedores->proveedor_monto_total_homogeneo = 0;
    
                        $presupuestacionproveedores->save();
    
                        // busco cada uno de los productos del proveedor para crear el objeto para enviar el mail
                        
                        $listaProductosXProveedorMail = collect();
    
                        foreach ($arrProductos as $itemProducto) {
                            if ($itemProducto->producto_rubro_id == $itemProveedores->proveedor_rubro_id) {
                                $datosProducto = [
                                    'nombre' => $itemProducto->producto_nombre,
                                    'cantidad' => $itemProducto->producto_cantidad_real_a_comprar,
                                ];
    
                                $listaProductosXProveedorMail->push($datosProducto);       
                            }
                        }
    
    
                        $objEnviarMail = [
                            'nombreProveedor' => $itemProveedores->proveedor_nombre,
                            'mailProveedor' => $itemProveedores->proveedor_mail,
                            'productos' => $listaProductosXProveedorMail,
                        ];
    
    
    
                        Mail::to($itemProveedores->proveedor_mail)->send(new TestMail($objEnviarMail, $listaProductosXProveedorMail));     
    
                    }
    
                }
            }
        }

        // $data = "Amor de mi vida";
        // Mail::to('sabrinampereyra@gmail.com')->send(new TestMail($data));  

        $presupuestacionBD = BorradorPresupuestacion::find($request->presupuestacion_id);
        
        $presupuestacionBD->borrador_presupuestado = 1;

        $presupuestacionBD->save();


        return $request->presupuestacion_plan_id;
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
    public function crear(Request $request){
        // recorro el arreglo de los rubros para generar una presupuestacion por cada rubro

        // foreach ($arrRubrosComprar as $itemRubro) {
            // primero guardo los datos de la presupuestacion
            $presupuestacion = new BorradorPresupuestacion();

            $presupuestacion->borrador_presupuestacion_plan_id = $request->presupuestacion_plan_id;

            $presupuestacion->borrador_presupuestacion_plan_nombre = $request->presupuestacion_plan_nombre;

            // $presupuestacion->presupuestacion_rubro_id = $itemRubro->rubro_id;

            // $presupuestacion->presupuestacion_rubro_nombre = $itemRubro->rubro_nombre;
            
            $presupuestacion->borrador_presupuestacion_fecha_incio = date('Y-m-d h:i:s', strtotime($request->presupuestacion_fecha_incio));

            $presupuestacion->borrador_presupuestacion_fecha_fin = date('Y-m-d h:i:s', strtotime($request->presupuestacion_fecha_fin));

            $presupuestacion->borrador_presupuestado = 0;
            
            $presupuestacion->save();



            // guardo los productos de la presupuestacion
            $presupuestacionBD = BorradorPresupuestacion::orderBy('borrador_presupuestacion_id', 'desc')->first();

            $arrRubrosComprar = json_decode($request->arrayRubrosAComprar);

            foreach ($arrRubrosComprar as $itemRubro) {
                $rubro = new BorradorPresupuestacionRubros();

                $rubro->borrador_presupuestacion_id = $presupuestacionBD->borrador_presupuestacion_id;

                $rubro->borrador_presupuestacion_rubro_id = $itemRubro->rubro_id;

                $rubro->borrador_presupuestacion_rubro_nombre = $itemRubro->rubro_nombre;

                $rubro->save();

                $arrProductos = json_decode($request->arrayProductosAComprarEnviar);

                foreach ($arrProductos as $itemProducto) {
                    if ($itemProducto->producto_rubro_id == $itemRubro->rubro_id) {
                        $presupuestacionproductos = new BorradorPresupuestacionProductos();

                        $presupuestacionproductos->borrador_presupuestacion_id = $presupuestacionBD->borrador_presupuestacion_id;
                
                        $presupuestacionproductos->borrador_presupuestacion_plan_id = $presupuestacionBD->borrador_presupuestacion_plan_id;

                        $presupuestacionproductos->borrador_producto_id = $itemProducto->producto_id;

                        $presupuestacionproductos->borrador_producto_nombre = $itemProducto->producto_nombre;

                        $presupuestacionproductos->borrador_producto_rubro_id = $itemProducto->producto_rubro_id;

                        $presupuestacionproductos->borrador_producto_rubro_nombre = $itemProducto->producto_rubro_nombre;

                        $presupuestacionproductos->borrador_producto_cantidad_a_comprar = $itemProducto->producto_cantidad_a_comprar;

                        $presupuestacionproductos->borrador_producto_cantidad_deposito = $itemProducto->producto_cantidad_deposito;

                        $presupuestacionproductos->borrador_producto_cantidad_real_a_comprar = $itemProducto->producto_cantidad_real_a_comprar;

                        $presupuestacionproductos->save();

                        

                    }
                }



                // guardo los proveedores de la presupuestacion
                $arrProveedores = json_decode($request->arrayProveedoresMostrarEnviar);

                foreach ($arrProveedores as $itemProveedores) {
                    if ($itemProveedores->proveedor_rubro_id == $itemRubro->rubro_id) {
                        $presupuestacionproveedores = new BorradorPresupuestacionProveedores();

                        $presupuestacionproveedores->borrador_presupuestacion_id = $presupuestacionBD->borrador_presupuestacion_id;
                        
                        $presupuestacionproveedores->borrador_presupuestacion_plan_id = $presupuestacionBD->borrador_presupuestacion_plan_id;

                        $presupuestacionproveedores->borrador_proveedor_id = $itemProveedores->proveedor_id;

                        $presupuestacionproveedores->borrador_proveedor_nombre = $itemProveedores->proveedor_nombre;

                        $presupuestacionproveedores->borrador_proveedor_rubro_id = $itemProveedores->proveedor_rubro_id;

                        $presupuestacionproveedores->borrador_proveedor_mail = $itemProveedores->proveedor_mail;

                        $presupuestacionproveedores->borrador_proveedor_monto_totalPP = 0; 
                        $presupuestacionproveedores->borrador_proveedor_monto_flete = 0;
                        $presupuestacionproveedores->borrador_proveedor_factura_A = 0;
                        $presupuestacionproveedores->borrador_proveedor_forma_de_pago = 0;
                        $presupuestacionproveedores->borrador_proveedor_monto_descuentos_bonificaciones = 0;
                        $presupuestacionproveedores->borrador_proveedor_monto_total_homogeneo = 0;

                        $presupuestacionproveedores->save();

                        // busco cada uno de los productos del proveedor para crear el objeto para enviar el mail
                        
                        // $listaProductosXProveedorMail = collect();

                        // foreach ($arrProductos as $itemProducto) {
                        //     if ($itemProducto->producto_rubro_id == $itemProveedores->proveedor_rubro_id) {
                        //         $datosProducto = [
                        //             'nombre' => $itemProducto->producto_nombre,
                        //             'cantidad' => $itemProducto->producto_cantidad_real_a_comprar,
                        //         ];

                        //         $listaProductosXProveedorMail->push($datosProducto);       
                        //     }
                        // }


                        // $objEnviarMail = [
                        //     'nombreProveedor' => $itemProveedores->proveedor_nombre,
                        //     'mailProveedor' => $itemProveedores->proveedor_mail,
                        //     'productos' => $listaProductosXProveedorMail,
                        // ];



                        // Mail::to($itemProveedores->proveedor_mail)->send(new TestMail($objEnviarMail, $listaProductosXProveedorMail));     

                    }

                }
            }


            
        // }

        return $presupuestacionBD->borrador_presupuestacion_id;
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
