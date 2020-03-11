<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
   
    //Nombre de la tabla
    protected $table="articulos";
    //Datos visibles para los objetos json
    protected $fillable=['id_categoria','nombre','descripcion','marca','fecha_compra','num_factura','num_piezas','art_exist','iva','precio_compra','porcentaje','precio_venta','ubicacion','status','id_proveedor'];
  

}
