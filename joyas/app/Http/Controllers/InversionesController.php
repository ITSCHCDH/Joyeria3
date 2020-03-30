<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inversion;
use App\Inversionista;
use DB;

class InversionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inversiones = DB::table('inversiones')
        ->join('inversionistas', 'inversiones.id_inversionista', '=', 'inversionistas.id')           
        ->select('inversiones.id','inversiones.fecha','inversiones.cantidad','inversiones.id_inversionista','inversionistas.nombre')->paginate(10);
           //dd( $inversiones);

        return view('Admin.inversiones.index')
        ->with('inversiones',$inversiones)
        ->with('inversionistas',Inversionista::all());

        
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
    public function store(Request $request,$id)
    {
        if($id==0)
        {
            return redirect()->route('inversiones.index')
            ->with('warning','Debes de seleccionar un inversionista valido');
        }
       
        DB::table('inversiones')->insert(
            ['fecha' =>$request->calendario , 'cantidad' =>$request->cantidad, 'id_inversionista'=>$id ]
        );
        
        return redirect()->route('inversiones.index')
        ->with('success','La inversión se registro correctamente');
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $inv)
    {
        $affected = DB::table('inversiones')
                ->where('id', $id)
                ->update(['fecha' => $request->calendario, 'cantidad'=>$request->cantidad,'id_inversionista'=>$inv]);
        return redirect()->route('inversiones.index')
        ->with('success','La inversión se modifico correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inv = Inversion::find($id);
        if($inv==null){
            return redirect()->route('inversiones.index')
            ->with('error','La inversión no existe');
        }
              
        $inv->delete();
        return redirect()->route('inversiones.index')
        ->with('success','La inversión se elimino correctamente');
    }
}
