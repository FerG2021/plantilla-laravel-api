<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Helpers\APIHelpers;
use Validator;


class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $proveedores = Proveedor::orderBy('created_at', 'desc')->get();

        return $proveedores;
    }

    public function getTodosSelect(){
        $proveedores = Proveedor::select('proveedor_id', 'proveedor_nombre')
            ->orderBy('proveedor_nombre', 'ASC')
            ->get();
        
        return $proveedores;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDatos($id)
    {   
        $proveedorBD = Proveedor::where('proveedor_auto','=',$id)->first(); 
        
        // $proveedorBD = Proveedor::find($id);

        

        if($proveedorBD){
            // $proveedorDevolver = $proveedorBD->obtenerObjDatos();                

            // // categoria
            // $categoriaDB = Categoria::find($articuloBD->idCategoria);
            // $categoriaDevolver = $categoriaDB->obtenerObjDatos();

            // // unidad de medida
            // $unidadMedidaDB = UnidadMedida::find($articuloBD->idUnidadMedida);
            // $unidadMedidaDevolver = $unidadMedidaDB->obtenerObjDatos();

            // $listaDevolver = [
            //     'id' => $articuloBD->id,
            //     'descripcion' => $articuloBD->descripcion,
            //     'idCategoria' => $articuloBD->idCategoria,
            //     'idUnidadMedida' => $articuloBD->idUnidadMedida,
            //     'precio' => $articuloBD->precio,
            //     'stock' => $articuloBD->stock,
            //     'categoria' => $categoriaDevolver,
            //     'unidadMedida' => $unidadMedidaDevolver,
            // ];



            // return $listaDevolver;
            return $proveedorBD;
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
    public function crear(Request $request)
    {
        $rules = [
            'id' => 'required | unique:App\Models\Proveedor,proveedor_id',

            'codigo' => 'required | unique:App\Models\Proveedor,proveedor_codigo',
            
            'nombre' => 'required | unique:App\Models\Proveedor,proveedor_nombre',
            
            'razonSocial' => 'required',

            'cuit' => 'required | unique:App\Models\Proveedor,proveedor_cuit',

            'email' => 'required | unique:App\Models\Proveedor,proveedor_email',

            'activo' => 'required',
        ];

        $messages = [
            'codigo.required' => 'El codigo es requerido',
            'codigo.unique' => 'Ya existe un proveedor registrado con el codigo ingresado',

            'nombre.required' => 'El nombre es requerido',
            'nombre.unique' => 'Ya existe un proveedor registrado con el nombre ingresado',

            'razonSocial.required' => 'La razon socail es requerida',

            'email.required' => 'El email es requerido',
            'email.unique' => 'Ya existe un proveedor registrado con el email ingresado',

            'activo.required' => 'La condicion de activo o inactivo es requerida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // $estado = 5;
            // return response()->json([$validator->errors()]);

            $respuesta = APIHelpers::createAPIResponse(true, 400, 'Se ha producido un error', $validator->errors());

            return response()->json($respuesta, 200);

        }

        $proveedor = new Proveedor();

        $proveedor->proveedor_id = $request->id;
        $proveedor->proveedor_codigo = $request->codigo;
        $proveedor->proveedor_nombre = $request->nombre;
        $proveedor->proveedor_razonsocial = $request->razonSocial;
        $proveedor->proveedor_cuit = $request->cuit;
        $proveedor->proveedor_email = $request->email;
        $proveedor->proveedor_activo = $request->activo;


        if ($proveedor->save()) {
            $respuesta = APIHelpers::createAPIResponse(false, 200, 'Proveedor creado con éxito', $validator->errors());

            return response()->json($respuesta, 200);
        }
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
