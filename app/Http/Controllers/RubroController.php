<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rubro;
use App\Helpers\APIHelpers;
use Validator;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodos()
    {
        $rubros = Rubro::orderBy('rubro_nombre', 'asc')->get();

        return $rubros;
    }

    public function getTodosSelect(){
        $rubros = Rubro::select('rubro_id', 'rubro_nombre')
            ->orderBy('rubro_nombre', 'ASC')
            ->get();
        
        return $rubros;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDatos($id)
    {   
        $rubroBD = Rubro::find($id); 
        

        if($rubroBD){
            $rubrorDevolver = $rubroBD->obtenerObjDatos();                

            // categoria
            $categoriaDB = Categoria::find($articuloBD->idCategoria);
            $categoriaDevolver = $categoriaDB->obtenerObjDatos();

            // unidad de medida
            $unidadMedidaDB = UnidadMedida::find($articuloBD->idUnidadMedida);
            $unidadMedidaDevolver = $unidadMedidaDB->obtenerObjDatos();

            $listaDevolver = [
                'id' => $rubroBD->id,
                'descripcion' => $articuloBD->descripcion,
                'idCategoria' => $articuloBD->idCategoria,
                'idUnidadMedida' => $articuloBD->idUnidadMedida,
                'precio' => $articuloBD->precio,
                'stock' => $articuloBD->stock,
                'categoria' => $categoriaDevolver,
                'unidadMedida' => $unidadMedidaDevolver,
            ];



            return $listaDevolver;
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
            'id' => 'required | unique:App\Models\Rubro,rubro_id',

            'nombre' => 'required | unique:App\Models\Rubro,rubro_nombre',
        ];

        $messages = [
            'id.required' => 'El id es requerido',
            'id.unique' => 'Ya existe un rubro registrado con el id ingresado',

            'nombre.required' => 'El nombre es requerido',
            'nombre.unique' => 'Ya existe un rubro registrado con el nombre ingresado',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            // $estado = 5;
            // return response()->json([$validator->errors()]);

            $respuesta = APIHelpers::createAPIResponse(true, 400, 'Se ha producido un error', $validator->errors());

            return response()->json($respuesta, 200);

        }

        $rubro = new Rubro();

        $rubro->rubro_id = $request->id;
        $rubro->rubro_nombre = $request->nombre;


        if ($rubro->save()) {
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
