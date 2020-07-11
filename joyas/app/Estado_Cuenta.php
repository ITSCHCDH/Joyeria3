<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Cuenta extends Model
{
      //Nombre de la tabla
    protected $table="estado_cuenta";
    //Datos visibles para los objetos json
    protected $fillable=['id_inversionista','concepto','monto','fecha'];
}
