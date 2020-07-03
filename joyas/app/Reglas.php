<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reglas extends Model
{
    //Nombre de la tabla
    protected $table="reglas_negocio";
    //Datos visibles para los objetos json
    protected $fillable=['prc_ganancia','prc_operacion']; 
}
