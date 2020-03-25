<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Articulo;
use DB;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $proveedores=Proveedor::select('id','nombre','direccion','rfc','telefono','email')->paginate(10);         
        return view('Admin.proveedores.index')
        ->with('proveedores',$proveedores); //Llama a la vista y le envia los articulos
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $nombre_ya_existe = Proveedor::where('nombre','=',$request->nombre)->get()->count() > 0? true: false;
        if($nombre_ya_existe){            
            return redirect()->route('proveedores.index')
            ->with('error','El proveedor ya se encuentra registrado');
        }
        //Recibimos los datos de la vista de altas y en este metodo es donde registramos los datos a la BD

        DB::table('proveedores')->insert(
        ['nombre' => $request->nombreA, 'direccion' => $request->direccionA, 'rfc' => $request->rfcA, 'telefono' => $request->telefonoA, 'email' => $request->emailA]
        );        
        return redirect()->route('proveedores.index')
        ->with('success','El proveedor se registro correctamente');
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
        $nombre_ya_existe = Proveedor::where([
            ['nombre','=',$request->nombre],
            ['id','<>',$request->id]
        ])->get()->count()>0?true: false;
        if($nombre_ya_existe)
        {               
            return redirect()->route('proveedores.index')
            ->with('error','El proveedor ya existe');
        }
        $pro = Proveedor::find($request->id);
        $pro->fill($request->all());
        $pro->save();
        return redirect()->route('proveedores.index')
        ->with('success','El proveedor se modifico correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pro = Proveedor::find($id);
        if($pro==null){
            return redirect()->route('proveedores.index')
            ->with('error','El proveedor no existe');
        }
        $tiene_articulos = Articulo::where('id_proveedor','=',$id)->get()->count() > 0? true: false;
       
        if($tiene_articulos)
        {
            return redirect()->route('proveedores.index')
            ->with('error','No se puede eliminar debido a que hay articulos registrados que dependen de este proveedor');            
        }
        $pro->delete();
        return redirect()->route('proveedores.index')
        ->with('success','El proveedor se elimino correctamente');
    }
}
