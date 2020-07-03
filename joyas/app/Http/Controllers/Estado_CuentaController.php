<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado_Cuenta;
use App\Venta;
use DB;

class Estado_CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $corte=Estado_Cuenta::select('id','fecha_corte','ventas_periodo','gastos_operativos','descripcion_gastos','gastos_extraordinarios','descripcion_gastos_extra')->paginate(10);
        $venPer=DB::table('ventas')                    
                     ->where('status', '=', '0')   
                     ->sum('total');
        //dd($venPer);
        return view('Admin.corte.index')
        ->with('corte',$corte); //Llama a la vista y le envia los articulos
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
        //
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
