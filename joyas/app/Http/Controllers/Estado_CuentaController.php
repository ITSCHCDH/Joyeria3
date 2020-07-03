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
        //Consultamos los cortes realizados historicamente
        $corte=Estado_Cuenta::select('id','fecha_corte','ventas_periodo','gastos_operativos','descripcion_gastos','gastos_extraordinarios','descripcion_gastos_extra')->paginate(10);
        //Consultamos el total de las ventas desde el ultimo corte a la fecha seleccionada
        $venPer=DB::table('ventas')                    
                     ->where('status', '=', '0')   
                     ->sum('total');
        //Obtenemos los gastos operativos en relacion a lo acordado en las reglas de negocio
        $prcOp=DB::table('reglas_negocio')
                   ->select('prc_operacion')->get();  
        foreach ($prcOp as $po) {
             $gasOp= ($venPer*$po->prc_operacion)/100; 
         } 
                     
        //dd($gasOp);
        return view('Admin.corte.index')
        ->with('corte',$corte) //Retornamos los cortes historicos
        ->with('venPer',$venPer) //Retornamos el total de las ventas del periodo
        ->with('gasOp',$gasOp); //Retornamos los gatos operativos establecidos en las reglas de negocio
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

        DB::beginTransaction();

        try 
        {
            DB::table('ventas')
            ->where('status', '0')
            ->update(['status' => '1']);

            DB::table('estado_cuenta')->insert(['fecha_corte' => $request->fecha_corte, 
                'ventas_periodo' => $request->ventas_periodo,'gastos_operativos'=>$request->gastos_operativos,'descripcion_gastos'=>$request->descripcion_gastos,'gastos_extraordinarios'=>$request->gastos_extraordinarios,'descripcion_gastos_extra'=>$request->descripcion_gastos_extra] );
            

            DB::commit();
            return redirect()->route('corte.index')
            ->with('success','El corte se realizo correctamente');
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
             return redirect()->route('corte.index')
            ->with('error','El corte no se pudo realizar');
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
