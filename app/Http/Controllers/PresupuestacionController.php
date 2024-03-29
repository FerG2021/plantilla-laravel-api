<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presupuestacion;
use App\Models\PresupuestacionProductos;
use App\Models\PresupuestacionProductosProveedores;
use App\Models\PresupuestacionProveedores;
use App\Models\Producto;
use App\Models\User;
use App\Models\Transferencia;
use App\Mail\TestMail;
use Mail;
use App\Helpers\APIHelpers;




class PresupuestacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $presupuestacionDB = Presupuestacion::orderBy('presupuestacion_id', 'desc')->get();

        $listaDevolver = collect();

        foreach ($presupuestacionDB as $item) {
            // productos de la presupuestacion
            // $presupuestacionproductosDB = PresupuestacionProductos::find($item->presupuestacion_id);

            $presupuestacionproductosDB = PresupuestacionProductos::where('presupuestacion_id', '=', $item->presupuestacion_id)->get();

            // $presupuestacionproductosDevolver = $presupuestacionproductosDB->obtenerObjDatos();

            // proveedores de la presupuestacion
            $proveedorespresupuestacionDB = PresupuestacionProveedores::where('presupuestacion_id', '=', $item->presupuestacion_id)->get();
            // $proveedorespresupuestacionDevolver = $proveedorespresupuestacionDB->obtenerObjDatos();

            $objDevolver = [
                'presupuestacion_id' => $item->presupuestacion_id,
                'presupuestacion_plan_id' => $item->presupuestacion_plan_id,
                'presupuestacion_plan_nombre' => $item->presupuestacion_plan_nombre,
                'presupuestacion_rubro_id' => $item->presupuestacion_rubro_id,
                'presupuestacion_rubro_nombre' => $item->presupuestacion_rubro_nombre,
                'presupuestacion_fecha_incio' => $item->presupuestacion_fecha_incio,
                'presupuestacion_fecha_fin' => $item->presupuestacion_fecha_fin,
                'presupuestacion_fecha_fin' => $item->presupuestacion_fecha_fin,
                'presupuestacion_fecha_creacion' => $item->created_at,
                // 'productos' => $presupuestacionproductosDevolver,
                'productos' => $presupuestacionproductosDB,

                'proveedores' => $proveedorespresupuestacionDB,
            ];

            $listaDevolver->push($objDevolver); 
        }

        return $listaDevolver;
    }

    public function getDatos($id){
        $presupuestacionBD = Presupuestacion::find($id);

        if ($presupuestacionBD) {
            // productos
            $listaProductosDevolver = collect();
            $productosDB = PresupuestacionProductos::where('presupuestacion_id', '=', $id)->get();

            foreach ($productosDB as $itemProductosDB) {
                $rubroDevolver = $itemProductosDB->obtenerObjDatos();

                $productoBD = Producto::find($itemProductosDB->producto_id);

                $productoDevolver = [
                    'productoPresupuestacion' => $rubroDevolver,
                    'producto' => $productoBD,
                ];

                $listaProductosDevolver->push($productoDevolver);
            }
            
            // proveedores
            $listaProveedoresDevolver = collect();
            $proveedoresDB = PresupuestacionProveedores::where('presupuestacion_id', '=', $id)->get();

            foreach ($proveedoresDB as $itemProveedores) {
                $proveedoresDevolver = $itemProveedores->obtenerObjDatos();

                $listaProveedoresDevolver->push($proveedoresDevolver);
            }

            $objDevolver = [
                'presupuestacion_id' => $presupuestacionBD->presupuestacion_id,
                'presupuestacion_plan_id' => $presupuestacionBD->presupuestacion_plan_id,
                'presupuestacion_plan_nombre' => $presupuestacionBD->presupuestacion_plan_nombre,
                'presupuestacion_rubro_id' => $presupuestacionBD->presupuestacion_rubro_id,
                'presupuestacion_rubro_nombre' => $presupuestacionBD->presupuestacion_rubro_nombre,
                'presupuestacion_fecha_incio' => $presupuestacionBD->presupuestacion_fecha_incio,
                'presupuestacion_fecha_fin' => $presupuestacionBD->presupuestacion_fecha_fin,
                'presupuesto_fecha_creacion' => $presupuestacionBD->created_at,
                'productos' => $listaProductosDevolver,
                'proveedores' => $listaProveedoresDevolver,
            ];
            
            return $objDevolver;

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
    public function crear(Request $request){
        // recorro el arreglo de los rubros para generar una presupuestacion por cada rubro
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

            $presupuestacion->presupuestacion_fecha_limite = date('Y-m-d h:i:s', strtotime($request->presupuestacion_fecha_limite));
            
            $presupuestacion->save();



            // busco la transferencia creada para tomar la presupuestacion_id
            $presupuestacionBD = Presupuestacion::orderBy('presupuestacion_id', 'desc')->first();

            // guardo los datos de la transferencia de cada uno de los productos utlizados
            $arrTransferencias = json_decode($request->arrTransferencias);

            foreach ($arrTransferencias as $itemTransferencia) {
                $transferencia = new Transferencia();

                $transferencia->transferencia_presupuestacion_id = $presupuestacionBD->presupuestacion_id;

                $transferencia->transferencia_deposito_id = $itemTransferencia->deposito_id;

                $transferencia->transferencia_deposito_producto_id = $itemTransferencia->deposito_producto_id;

                $transferencia->transferencia_producto_activo = $itemTransferencia->producto_activo;

                $transferencia->transferencia_producto_id = $itemTransferencia->producto_id;

                $transferencia->transferencia_producto_nombre = $itemTransferencia->producto_nombre;

                $transferencia->transferencia_producto_stock = $itemTransferencia->producto_stock;

                $transferencia->transferencia_producto_unidad = $itemTransferencia->producto_unidad;

                $transferencia->transferencia_producto_rubro_id = $itemTransferencia->rubro_id;

                $transferencia->transferencia_cantidad_utilizar = $itemTransferencia->cantidad_utilizar;

                $transferencia->transferencia_estado = 'Pendiente';

                $transferencia->save();
            }


            // guardo los productos de la presupuestacion
            $arrProductos = json_decode($request->arrayProductosAComprarEnviar);


            foreach ($arrProductos as $itemProducto) {
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

                    $presupuestacionproductos->producto_observaciones = $itemProducto->producto_observaciones;

                    $presupuestacionproductos->save();

                    

                }
            }

            // guardo los proveedores de la presupuestacion
            $arrProveedores = json_decode($request->arrayProveedoresMostrarEnviar);

            foreach ($arrProveedores as $itemProveedores) {
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
                                'unidadMedida' => $itemProducto->producto_unidad_medida,
                                'observaciones' =>$itemProducto->producto_observaciones,
                            ];

                            $listaProductosXProveedorMail->push($datosProducto);       
                        }
                    }
                    

                    // busco el proveedor para pasarle el mail y la contraseña
                    $proveedoresMail = User::where('proveedor_id', '=', $itemProveedores->proveedor_id)->first();

                    $objEnviarMail = [
                        'nombreProveedor' => $itemProveedores->proveedor_nombre,
                        'mailProveedor' => $itemProveedores->proveedor_mail,
                        'contrasenaProveedor' => $proveedoresMail->password_plain,
                        'proveedorID' => $proveedoresMail->proveedor_id,
                        'fechaLimiteCarga' => $request->presupuestacion_fecha_limite,
                        'presupuestacionID' => $presupuestacionBD->presupuestacion_id,
                        'productos' => $listaProductosXProveedorMail,
                    ];



                    Mail::to($itemProveedores->proveedor_mail)
                        ->send(new TestMail($objEnviarMail, $listaProductosXProveedorMail));     

                }

            }
        }
        return $request->presupuestacion_plan_id;

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct(Request $request)
    {
        $presupuestacionproductosDB = PresupuestacionProductos::where('presupuestacion_id', '=', $request->presupuestacion_id)
        ->where('producto_id', '=', $request->producto_id)
        ->delete();

        $presupuestacionproductosproveedoresDB = PresupuestacionProductosProveedores::where('presupuestacion_id', '=', $request->presupuestacion_id)
        ->where('producto_id', '=', $request->producto_id)
        ->delete();

        $respuesta = APIHelpers::createAPIResponse(false, 200, 'Producto eliminado con éxito', 'Producto eliminado con éxito');

        return response()->json($respuesta, 200);

        // $listaDevolver = collect();

        // $objReturn = [
        //     'presupuestacionproductosDB' => $presupuestacionproductosDB,
        //     'presupuestacionproductosproveedoresDB' => $presupuestacionproductosproveedoresDB,
        // ];

        // $listaDevolver->push($objReturn);


        // return $objReturn;

        
    }

}
