<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reglas;
use DB;

class ReglasController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reglas=DB::table('reglas_negocio')->get();  
        return view('Admin.reglas.index')
        ->with('reglas',$reglas);
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
        //Recibimos los datos de la vista de altas y en este metodo es donde registramos los datos a la BD

        DB::table('reglas_negocio')->insert(
        ['prc_ganancia' => $request->prc_ganancia, 'prc_operacion' => $request->prc_operacion]
        );        
        return redirect()->route('reglas.index')
        ->with('success','Los parametros se registrarón correctamente');
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
         //Recibimos los datos de la vista y registramos los datos a la BD
        $reg = Reglas::find($request->id);
        $reg->fill($request->all());
        $reg->save();
        return redirect()->route('reglas.index')
        ->with('warning','Se modificarón correctamente las reglas de operación'); 
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
