<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedorxrubro;
use App\Models\Proveedor;
use App\Models\Rubro;


class ProveedorxrubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $proveedorxrubroDB = Proveedorxrubro::all();
        return $proveedorxrubroDB;
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
     * Show the form for creating a new resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDatos($id)
    {
        $proveedorxrubroDB = Proveedorxrubro::where('proveedor_id',"=",$id)->get();
        // echo $proveedorxrubroDB;
        $listaDevolver = collect();

        foreach ($proveedorxrubroDB as $item) {
            $rubroDB = Rubro::find($item->rubro_id);
            $rubroDevolver = $rubroDB->obtenerObjDatos();

            $proveedorDB = Proveedor::find($item->proveedor_id);
            $proveedorDevolver = $proveedorDB->obtenerObjDatos();

            $objDevolver = [
                'proveedorxrubro_auto' => $item->proveedorxrubro_auto,
                'proveedor_id' => $item->proveedor_id,
                'rubro_id' => $item->rubro_id,
                'rubro' => $rubroDevolver,
                'proveedor' => $proveedorDevolver
            ];

            $listaDevolver->push($objDevolver);
        }

        return $listaDevolver;

        // return $proveedorxrubroDB;
    }


    /**
     * Show the form for creating a new resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProveedorxRubro(Request $request){
        $arrProveedorRubro = json_decode($request->arrRubrosAComprar); 

        $listaDevolver = collect();


        foreach ($arrProveedorRubro as $item) {
            $proveedorxrubroDB = ProveedorxRubro::where('rubro_id','=',$item->rubro_id)->get();

            foreach ($proveedorxrubroDB as $item1) {
                $proveedorDB = Proveedor::find($item1->proveedor_id);
                $proveedorDevolver = $proveedorDB->obtenerObjDatos();

                $objDevolver = [
                    'rubro_id' => $item->rubro_id,
                    'rubro_nombre' => $item->rubro_nombre,
                    'proveedor' => $proveedorDevolver
                ];
    
                $listaDevolver->push($objDevolver);

            }
        };

        return $listaDevolver;

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        $arrProveedorRubro = json_decode($request->arrProveedorRubro);
        // $arrProveedorRubro = json_decode($arrProveedorRubro);
        
        // primero elimino todas las relaciones del proveedor
        Proveedorxrubro::where('proveedor_id','=',$arrProveedorRubro[0]->proveedor_id)->delete();
        

        foreach ($arrProveedorRubro as $item) {
            $proveedorxrubro = new Proveedorxrubro();

            $proveedorxrubro->proveedor_id = $item->proveedor_id;
            $proveedorxrubro->rubro_id = $item->rubro_id;

            $proveedorxrubro->save();
        };


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
