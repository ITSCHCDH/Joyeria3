<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
     //Nombre de la tabla
    protected $table="ventas";
    //Datos visibles para los objetos json
    protected $fillable=['fecha','descripcion','total','status'];
}
