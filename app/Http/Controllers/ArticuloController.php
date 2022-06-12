<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\UnidadMedida;
use App\Http\Clases\Respuesta;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // muestra todos los registros
        $articulos = Articulo::orderBy('created_at', 'desc')->get();

        $listaDevolver = collect();
        foreach ($articulos as $item) {
            // categoria
            $categoriaDB = Categoria::find($item->idCategoria);
            $categoriaDevolver = $categoriaDB->obtenerObjDatos();
            
            // unidad de medida
            $unidadMedidaDB = UnidadMedida::find($item->idUnidadMedida);
            $unidadMedidaDevolver = $unidadMedidaDB->obtenerObjDatos();

            $objDevolver = [
                'id' => $item->id,
                'descripcion' => $item->descripcion,
                'idCategoria' => $item->idCategoria,
                'idUnidadMedida' => $item->idUnidadMedida,
                'precio' => $item->precio,
                'stock' => $item->stock,
                'categoria' => $categoriaDevolver,
                'unidadMedida' => $unidadMedidaDevolver,
            ];
                
            $listaDevolver->push($objDevolver);   


        }

        return $listaDevolver;
    }

    public function getTodosSelect(){
        $articulos = Articulo::select('id', 'descripcion')
            ->orderBy('descripcion', 'ASC')
            ->get();
        
        return $articulos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDatos($id)
    {   
        $articuloBD = Articulo::find($id); 
        

        if($articuloBD){
            $articuloDevolver = $articuloBD->obtenerObjDatos();                

            // categoria
            $categoriaDB = Categoria::find($articuloBD->idCategoria);
            $categoriaDevolver = $categoriaDB->obtenerObjDatos();

            // unidad de medida
            $unidadMedidaDB = UnidadMedida::find($articuloBD->idUnidadMedida);
            $unidadMedidaDevolver = $unidadMedidaDB->obtenerObjDatos();

            $listaDevolver = [
                'id' => $articuloBD->id,
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
    public function store(Request $request)
    {
        // guardo un nuevo registro creado
        $articulo = new Articulo();
        // guardo los datos que vienen del cliente en la bd por medio de la api
        $articulo->descripcion = $request->descripcion;
        $articulo->precio = $request->precio;
        $articulo->stock = $request->stock;
        $articulo->idCategoria = $request->idCategoria;
        $articulo->idUnidadMedida = $request->idUnidadMedida;


        $articulo->save();
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
    public function update(Request $request)
    {
        // modificacion de un registro
        $articulo = Articulo::findOrFail($request->id);

        $articulo->descripcion = $request->descripcion;
        $articulo->precio = $request->precio;
        $articulo->stock = $request->stock;
        $articulo->idCategoria = $request->idCategoria;
        $articulo->idUnidadMedida = $request->idUnidadMedida;

        $articulo->save();

        return $articulo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // eliminar un registro
        $articulo = Articulo::destroy($request->id);
        return $articulo;
    }
}
