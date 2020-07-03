<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inversionista extends Model
{
     //Nombre de la tabla
    protected $table="inversionistas";
    //Datos visibles para los objetos json
    protected $fillable=['nombre','dividendos']; 
    
}
