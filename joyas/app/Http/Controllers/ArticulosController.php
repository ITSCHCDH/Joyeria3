<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;  //Modelo para poder hacer la consulta de usuarios
use App\Proveedor;
use App\Categoria;
use DB;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $articulos = DB::table('articulos as a')
        ->join('categorias as c', 'a.id_categoria', '=', 'c.id')           
        ->select('c.categoria','a.*')->paginate(10);       
        
        return view('Admin.articulos.index')
        ->with('articulos',$articulos)
        ->with('proveedores',Proveedor::all())
        ->with('categorias',Categoria::all());
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id_cat,$id_pro)
    {
        //dd("Si llega");
        $nombre_ya_existe = Articulo::where('nombre','=',$request->nombre)->get()->count() > 0? true: false;
        if($nombre_ya_existe){            
            return redirect()->route('articulos.index')
            ->with('error','El articulo ya esta dado de alta');
        }
        //Recibimos los datos de la vista de altas y en este metodo es donde registramos los datos a la BD
        $art = new Articulo($request->all());              
        $art->id_categoria=$id_cat;
        $art->id_proveedor=$id_pro;
        $art->save();
        
        return redirect()->route('articulos.index')
        ->with('success','El articulo se registro correctamente');
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
        $nombre_ya_existe = Articulo::where([
            ['nombre','=',$request->nombre],
            ['id','<>',$id]
        ])->get()->count()>0?true: false;
        if($nombre_ya_existe){
            return redirect()->route('articulos.index')
            ->with('error','El articulo ya existe');
        }
        $art = Articulo::find($id);
        $art->fill($request->all());
        //
        $art->save();
       return redirect()->route('articulos.index')
        ->with('success','El articulo se modifico correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $art = Articulo::find($id);
        if($art==null){
            return redirect()->route('articulos.index')
            ->with('error','El articulo no existe');
        }        
        $art->delete();
        return redirect()->route('articulos.index')
        ->with('success','El articulo se elimino correctamente');
    }
}
