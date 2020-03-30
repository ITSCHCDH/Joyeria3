<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;  //Modelo para poder hacer la consulta de usuarios
use DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Dos formas de hacer consultas en laravel
        //$usuarios = DB::select('select * from users'); //1

        $usuarios=User::select('*')->paginate(10);  //2    
        //$usuarios=User::all();
        return view('Admin.usuarios.index')
        ->with('usuarios',$usuarios); //Llama a la vista y le envia los usuarios 
      
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
        $nombre_ya_existe = User::where([
            ['name','=',$request->name],
            ['id','<>',$request->id]
        ])->get()->count()>0?true: false;
        if($nombre_ya_existe)
        {               
            return redirect()->route('usuarios')
            ->with('error','El usuario ya existe');
        }
        $us = User::find($request->id);
        $us->fill($request->all());
        $us->save();
        return redirect()->route('usuarios')
        ->with('success','El usuario se modifico correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $us = User::find($id);        
        $us->delete();
        return redirect()->route('usuarios')
        ->with('success','El usuario se elimino correctamente');
    }
}
