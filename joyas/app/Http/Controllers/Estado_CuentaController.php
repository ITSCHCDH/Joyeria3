<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado_Cuenta;
use App\Inversionista;
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
        $inversiones=DB::table('estado_cuenta')
        ->join('inversionistas', 'id_inversionista', '=', 'inversionistas.id')           
        ->select('estado_cuenta.*', 'inversionistas.nombre')
        ->where('estado_cuenta.concepto', '=', 'inversion')
        ->orderBy('estado_cuenta.id')
        ->paginate(10);       
        $inversionistas=DB::table('inversionistas')->get();          
        return view('Admin.inversiones.index')
        ->with('inversiones',$inversiones)
        ->with('inversionistas',$inversionistas);
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
    public function store(Request $request, $id_inv)
    {
        //Alta de inverión
        DB::table('estado_cuenta')->insert(
            [
                'id_inversionista' => $id_inv, 
                'monto' => $request->monto,
                'fecha'=>$request->fecha,
                'concepto'=>'inversion',
                'corte'=>'N/A'
            ]
        );

        return redirect()->route('estado_cuenta.index')
        ->with('success','La inversión se registro correctamente');
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
    public function update(Request $request, $id,$id_inv)
    {
        DB::table('estado_cuenta')
              ->where('id', $id)
              ->update(
              [
                'id_inversionista' => $id_inv, 
                'monto' => $request->monto,
                'fecha'=>$request->fecha,
                'concepto'=>'inversion',
                'corte'=>'N/A'
              ]);

        return redirect()->route('estado_cuenta.index')
        ->with('warning','La inversión se modifico correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('estado_cuenta')->where('id', '=', $id)->delete();
        return redirect()->route('estado_cuenta.index')
        ->with('error','La inversión se elimino correctamente');
    }
}
