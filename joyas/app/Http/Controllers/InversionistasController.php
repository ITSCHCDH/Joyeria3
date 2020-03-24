<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inversionista;
use DB;

class InversionistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inversionistas=Inversionista::select('id','nombre')->paginate(10);          
        return view('Admin.inversionistas.index')
        ->with('inversionistas',$inversionistas);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre_ya_existe = Inversionista::where('nombre','=',$request->nombre)->get()->count() > 0? true: false;
        if($nombre_ya_existe){            
            return redirect()->route('inversionistas.index')
            ->with('error','El inversionista ya esta dado de alta');
        }
        //Recibimos los datos de la vista de altas y en este metodo es donde registramos los datos a la BD
        $inv = new Inversionista($request->all());      
       
        //Comando para guardar el registro      
        $inv->save();
        
        return redirect()->route('inversionistas.index')
        ->with('success','El inversionista se registro correctamente');
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
