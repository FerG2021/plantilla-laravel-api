<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\APIHelpers;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraProductos;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\CondicionPago;
use App\Models\Plan;
use App\Models\Comparativa;
use App\Models\BorradorComparativa;
use App\Models\BorradorComparativaProveedores;
use App\Models\BorradorComparativaProductosProveedores;
use GuzzleHttpClient;
use Illuminate\Support\Facades\Http;

class OrdenCompraController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        // recorro el array que trae los datos para las ordendes de compra
        $arrOrdenesCompra = json_decode($request->arrayOrdenesCompra);

        // recibo el array de los datos para guardar los datos
        $arrayDatosBorrador = json_decode($request->arrayDatosBorrador);

        // pregunto si hay un borrador creado para la presupuestacion_id
        $borradorComparativa = BorradorComparativa::where('borrador_comparativa_presupuestacion_id' , '=', $request->presupuestacion_id)->first();


        // guardo los datos del borrador, se usan las mismas tablas ya que una vez que se generen las ordenes de compra no se puede modificar la comparativa

        // recorro el array para obtener los datos
        foreach ($arrayDatosBorrador as $item) {
            // proveedores
            $proveedor = BorradorComparativaProveedores::where('presupuestacion_id', '=', $item->presupuestacion_id)
            ->where('proveedor_id', '=', $item->proveedor_id)->first();

            
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


        // genero una compartiva, luego si busco la comparativa por presupuestacion_id significa que ya se creo una y no se pueden volver a editar los datos
        $comparativa = new Comparativa();

        $comparativa->comparativa_presupuestacion_id = $request->presupuestacion_id;
        $comparativa->save();



        // genero las ordenes de compra
        foreach ($arrOrdenesCompra as $itemOrdenCompra) {
            // guardo los datos de cada una de las ordenes de compra
            $ordenCompra = new OrdenCompra();
                
            $ordenCompra->ordenes_compras_proveedor_id = $itemOrdenCompra->proveedor_id;
            
            $ordenCompra->ordenes_compras_presupuestacion_id = $itemOrdenCompra->presupuestacion_id;
            
            $ordenCompra->ordenes_compras_presupuestacion_plan_id = $itemOrdenCompra->presupuestacion_plan_id;
            
            $ordenCompra->ordenes_compras_proveedor_nombre = $itemOrdenCompra->proveedor_nombre;
            
            $ordenCompra->ordenes_compras_proveedor_mail = $itemOrdenCompra->proveedor_mail;
            
            $ordenCompra->ordenes_compras_proveedor_factura_A = $itemOrdenCompra->proveedor_factura_A;
            
            $ordenCompra->ordenes_compras_proveedor_forma_de_pago = $itemOrdenCompra->proveedor_forma_de_pago;
            
            $ordenCompra->ordenes_compras_descuentos_bonificaciones = $itemOrdenCompra->proveedor_monto_descuentos_bonificaciones;
            
            $ordenCompra->ordenes_compras_monto_flete = $itemOrdenCompra->proveedor_monto_flete;
            
            $ordenCompra->ordenes_compras_monto_total_PP = $itemOrdenCompra->proveedor_monto_totalPP;
            
            $ordenCompra->ordenes_compras_monto_total_homogeneo = $itemOrdenCompra->proveedor_monto_total_homogeneo;
            
            $ordenCompra->ordenes_compras_presupuestacion_proveedor_id = $itemOrdenCompra->presupuestacion_proveedor_id;
            
            $ordenCompra->ordenes_compras_presupuestacion_proveedor_rubro_id = $itemOrdenCompra->proveedor_rubro_id;
            
            $ordenCompra->ordenes_compras_monto_total = $itemOrdenCompra->montoTotalOrdenCompra;

            $ordenCompra->ordenes_compras_estado = 0;

            $ordenCompra->save();

            // busco la orden de compra creada para tomar la presupuestacion_id
            $ordenCompraBD = OrdenCompra::orderBy('ordenes_compras_id', 'desc')->first();

            // guardo los datos de cada uno de los productos de cada una de las ordenes de compra
            $arrProductosOrdenesCompra = json_decode($itemOrdenCompra->productos);

            foreach ($arrProductosOrdenesCompra as $itemProductoOrdenCompra) {
                $ordenCompraProductos = new OrdenCompraProductos();

                $ordenCompraProductos->ordenes_compras_id = $ordenCompraBD->ordenes_compras_id;
                
                $ordenCompraProductos->ordenes_compras_productos_cantidad_proveedor = $itemProductoOrdenCompra->cantidad_proveedor;
                
                $ordenCompraProductos->ordenes_compras_productos_iva = $itemProductoOrdenCompra->iva;
                
                $ordenCompraProductos->ordenes_compras_productos_precio_png = $itemProductoOrdenCompra->precio_png;
                
                $ordenCompraProductos->ordenes_compras_productos_precio_pp = $itemProductoOrdenCompra->precio_pp;
                
                $ordenCompraProductos->ordenes_compras_productos_precio_pu = $itemProductoOrdenCompra->precio_pu;
                
                $ordenCompraProductos->ordenes_compras_productos_presupuestacion_id = $itemProductoOrdenCompra->presupuestacion_id;
                
                $ordenCompraProductos->ordenes_compras_productos_plan_id = $itemProductoOrdenCompra->presupuestacion_plan_id;
                
                $ordenCompraProductos->ordenes_compras_productos_producto_id = $itemProductoOrdenCompra->producto_id;
                
                $ordenCompraProductos->ordenes_compras_productos_producto_proveedor_id = $itemProductoOrdenCompra->proveedor_id;
                
                $ordenCompraProductos->ordenes_compras_productos_rubro_id = $itemProductoOrdenCompra->presupuestacion_rubro_id;
                
                $ordenCompraProductos->ordenes_compras_productos_rubro_nombre = $itemProductoOrdenCompra->presupuestacion_rubro_nombre;
                
                $ordenCompraProductos->ordenes_compras_productos_cantidad_a_comprar = $itemProductoOrdenCompra->producto_cantidad_a_comprar;
                
                $ordenCompraProductos->ordenes_compras_productos_producto_nombre = $itemProductoOrdenCompra->producto_nombre;
                
                // $ordenCompraProductos->ordenes_compras_productos_proveedor_id = $itemProductoOrdenCompra->presupuestacion_productos_proveedores_id;

                $ordenCompraProductos->ordenes_compras_productos_proveedor_id = $itemProductoOrdenCompra->proveedor_id;

                
                $ordenCompraProductos->ordenes_compras_productos_proveedor_mail = $itemProductoOrdenCompra->proveedor_mail;
                
                $ordenCompraProductos->ordenes_compras_productos_proveedor_nombre = $itemProductoOrdenCompra->proveedor_nombre;
                
                $ordenCompraProductos->ordenes_compras_productos_total_iva = $itemProductoOrdenCompra->iva;

                $ordenCompraProductos->save();
            }
        }


        $respuesta = APIHelpers::createAPIResponse(false, 200, 'Órdenes de compra generadas con éxito', null);

        return $respuesta;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerToken()
    {
        $client = new \GuzzleHttp\Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://2.teamplace.finneg.com',
        ]);

        $response = $client->request('GET', '/BSA/api/oauth/token', [
            'query' => [
                'grant_type' => 'client_credentials',
                'client_id' => '546aed61e07e0a1bf15187826411ec59',
                'client_secret' => 'b7444b18891462bd6e856d58c09af151',
            ]
        ]);

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviarOrdenCompra(Request $request)
    {
        $client = new \GuzzleHttp\Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://2.teamplace.finneg.com',
        ]);

        $url = '/BSA/api/ordenCompra?ACCESS_TOKEN=' . $request->token;

        $response = $client->request('POST', $url, 
            [
                // 'ACCESS_TOKEN' => $request->token,
                // 'body' => [
                //     json_encode($request->ordenCompra),
                // ] 

                'json' => $request->ordenCompra,
            ]
        );

        if ( $response->getStatusCode() == 200) {

            $ordenCompra = OrdenCompra::where('ordenes_compras_id', '=', $request->ordenCompraID)->first();

            if ($ordenCompra) {
                $ordenCompra->ordenes_compras_estado = 1;

                if ($ordenCompra->save()) {
                    return $response->getBody();                    
                }
            }
        } else {
            return $response;
        }


        

        // $response = Http::post('https://2.teamplace.finneg.com/BSA/api/ordenCompra', [
        //     'ACCESS_TOKEN' => $request->token,
        //     'body' =>  json_encode($request->ordenCompra),
        // ]);

        // $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $out->writeln($response);

        

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviarOrdenCompraAdelantada(Request $request)
    {
        $client = new \GuzzleHttp\Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://2.teamplace.finneg.com',
        ]);

        $url = '/BSA/api/ordenCompraAdelantada?ACCESS_TOKEN=' . $request->token;

        $response = $client->request('POST', $url, 
            [
                // 'ACCESS_TOKEN' => $request->token,
                // 'body' => [
                //     json_encode($request->ordenCompra),
                // ] 

                'json' => $request->ordenCompra,
            ]
        );

        if ( $response->getStatusCode() == 200) {

            $ordenCompra = OrdenCompra::where('ordenes_compras_id', '=', $request->ordenCompraID)->first();

            if ($ordenCompra) {
                $ordenCompra->ordenes_compras_estado = 1;

                if ($ordenCompra->save()) {
                    return $response->getBody();                    
                }
            }
        } else {
            return $response;
        }


        

        // $response = Http::post('https://2.teamplace.finneg.com/BSA/api/ordenCompra', [
        //     'ACCESS_TOKEN' => $request->token,
        //     'body' =>  json_encode($request->ordenCompra),
        // ]);

        // $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $out->writeln($response);

        

       
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
    public function getTodos()
    {
        $ordenCompraBD = OrdenCompra::orderBy('ordenes_compras_id', 'desc')->get();

        return $ordenCompraBD;
    }

    public function getDatos($id)
    {
        $ordenCompraBD = OrdenCompra::where('ordenes_compras_id', '=', $id)->first();

        $tipoFormaPagoDB = CondicionPago::where('condicionpago_id', '=', $ordenCompraBD->ordenes_compras_proveedor_forma_de_pago)->first();

        $planDB = Plan::where('pLan_id', '=', $ordenCompraBD->ordenes_compras_presupuestacion_plan_id)->first();

        $proveedorBD = Proveedor::where('proveedor_id', '=', $ordenCompraBD->ordenes_compras_proveedor_id)->first();

        $ordenCompraProductosBD = OrdenCompraProductos::where('ordenes_compras_id', '=', $id)->get();

        $listaProductosDevolver = collect();

        foreach ($ordenCompraProductosBD as $itemOrdenCompraProductosBD) {
            $productoDevolver = $itemOrdenCompraProductosBD->obtenerObjDatos();
            
            $productoDatosDB = Producto::where('producto_id', '=', $itemOrdenCompraProductosBD->ordenes_compras_productos_producto_id)->first();

            $objProductosDevolver = [
                'productoOrdenCompra' => $productoDevolver,
                'producto' => $productoDatosDB,
            ];


            // $listaProductosDevolver->push($productoDevolver);
            $listaProductosDevolver->push($objProductosDevolver);

        }


        $objDevolver = [
            'ordenCompra' => $ordenCompraBD,
            'plan' => $planDB,
            'formaPago' => $tipoFormaPagoDB,
            'productosOrdenCompra' => $listaProductosDevolver,
            'proveedorOrdenCompra' => $proveedorBD,
        ];

        // return $listaProductosDevolver;
        return $objDevolver;


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
