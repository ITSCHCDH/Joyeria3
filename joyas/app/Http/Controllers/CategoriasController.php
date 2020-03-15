<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use DB;
use Laracasts\Flash\Flash;

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
        $nombre_ya_existe = Categoria::where('categoria','=',$request->categoria)->get()->count() > 0? true: false;
        if($nombre_ya_existe){            
            return redirect()->back();
        }
        //Recibimos los datos de la vista de altas y en este metodo es donde registramos los datos a la BD
        $cat = new Categoria($request->all());      
       
        //Comando para guardar el registro      
        $cat->save();
        
        return redirect()->route('categorias.index')
        ->with('success','La categoria se registro correctamente');
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
    //Metodo que busca el articulo a editar
    public function edit($id)
    {
      //
    }
    
    //Metodo que actualiza la categoria en la bd
    public function actualizar(Request $request,$id){             
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
         $cat = Categoria::find($id);
        if($cat==null){           
            return view('admin.areas.editar')        
            ->with('danger','La categoria no existe');
        }
        return view('admin.areas.editar')
        ->with('cat',$cat);
    }

    public function eliminar($id)
    {
        //
    }
}
