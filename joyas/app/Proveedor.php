<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
     //Nombre de la tabla
    protected $table="proveedores";
    //Datos visibles para los objetos json
    protected $fillable=['nombre','direccion','rfc','telefono','email'];
}
