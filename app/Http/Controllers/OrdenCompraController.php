<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraProductos;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\CondicionPago;
use App\Models\Plan;

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
                
                $ordenCompraProductos->ordenes_compras_productos_proveedor_id = $itemProductoOrdenCompra->presupuestacion_productos_proveedores_id;
                
                $ordenCompraProductos->ordenes_compras_productos_proveedor_mail = $itemProductoOrdenCompra->proveedor_mail;
                
                $ordenCompraProductos->ordenes_compras_productos_proveedor_nombre = $itemProductoOrdenCompra->proveedor_nombre;
                
                $ordenCompraProductos->ordenes_compras_productos_total_iva = $itemProductoOrdenCompra->iva;

                $ordenCompraProductos->save();
            }
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
