<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
     //Nombre de la tabla
    protected $table="categorias";
    //Datos visibles para los objetos json
    protected $fillable=['categoria'];
}
