<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
     //Nombre de la tabla
    protected $table="inversiones";
    //Datos visibles para los objetos json
    protected $fillable=['fecha','cantidad','id_inversionista'];
}
