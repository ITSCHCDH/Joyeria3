<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\Venta;
use DB;
use Carbon\Carbon;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos=Articulo::select('*')->where('status', 'Existente')->paginate(10);            
         return view('Admin.ventas.index')
         ->with('articulos',$articulos); 
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $descrip="";
        $date = Carbon::now()->toDateTimeString();
        $nelem=count($request->nom);
        for($x=0; $x<$nelem; $x++)
        {
            $descrip=$descrip."/".$request->can[$x]."|".$request->nom[$x]."|".$request->des[$x];            
        }
        //Iniciamos la transacción
        DB::beginTransaction();
        try 
        {
            for($x=0;$x<$nelem;$x++)
            {
                //Consultamos la cantidad existente de los articulos
                $cant=Articulo::select('art_exist')->where('id', $request->id[$x])->get();       
                //Restamos la cantidad vendida a la existencia               
                $res=$cant[0]->art_exist-$request->can[$x];
                
                if($res!=0)
                {
                    //Hacemos la modificacion en la bd, con la nueva cantidad existente
                    DB::table('articulos')
                    ->where('id', $request->id[$x])
                    ->update(['art_exist' => $res]);
                }
                else
                {
                     //Hacemos la modificacion en la bd, con la nueva cantidad existente
                    DB::table('articulos')
                    ->where('id', $request->id[$x])
                    ->update(['art_exist' => $res,'status'=>'Vendido']);
                }
               
            }
            DB::table('ventas')
            ->insert([
                ['fecha' => $date, 'descripcion' => $descrip,'total'=>$request->total,'status'=>'0']
            ]); 
        }
        // Ha ocurrido un error, devolvemos la BD a su estado previo y hacemos lo que queramos con esa excepción
        catch (\Exception $e)
        {
            DB::rollback();                
            return redirect()->route('ventas.index')           
            ->with('error','La venta no se pudo realizar, verifique la cantidad de existencias');
        }
        // Hacemos los cambios permanentes ya que no han habido errores
        DB::commit();              
        return redirect()->route('ventas.index')       
        ->with('success','La venta se registro correctamente');
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
