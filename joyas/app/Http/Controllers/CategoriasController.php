<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Articulo;
use DB;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias=Categoria::select('id','categoria')->paginate(10);          
        return view('Admin.categorias.index')
        ->with('categorias',$categorias); //Llama a la vista y le envia los articulos 
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre_ya_existe = Categoria::where('categoria','=',$request->categoria)->get()->count() > 0? true: false;
        if($nombre_ya_existe){            
            return redirect()->route('categorias.index')
            ->with('error','La categoria ya esta dada de alta');
        }
        //Recibimos los datos de la vista de altas y en este metodo es donde registramos los datos a la BD
        $cat = new Categoria($request->all());      
       
        //Comando para guardar el registro      
        $cat->save();
        
        return redirect()->route('categorias.index')
        ->with('success','La categoria se registro correctamente');
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
        $nombre_ya_existe = Categoria::where([
            ['categoria','=',$request->categoria],
            ['id','<>',$request->id]
        ])->get()->count()>0?true: false;
        if($nombre_ya_existe)
        {               
            return redirect()->route('categorias.index')
            ->with('error','La categoria ya existe');
        }
        $cat = Categoria::find($request->id);
        $cat->fill($request->all());
        $cat->save();
        return redirect()->route('categorias.index')
        ->with('success','La categoria se modifico correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $cat = Categoria::find($id);
        if($cat==null){
            return redirect()->route('categorias.index')
            ->with('error','La categoria no existe');
        }
        $tiene_articulos = Articulo::where('id_categoria','=',$id)->get()->count() > 0? true: false;
       
        if($tiene_articulos)
        {
            return redirect()->route('categorias.index')
            ->with('error','No se puede eliminar debido a que hay articulos registrados que dependen de esta categoria');            
        }
        $cat->delete();
        return redirect()->route('categorias.index')
        ->with('success','La categoria se elimino correctamente');
    }

 
}
