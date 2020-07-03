<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Cuenta extends Model
{
     //Nombre de la tabla
    protected $table="Estado_Cuenta";
    //Datos visibles para los objetos json
    protected $fillable=['fecha_corte','ventas_periodo','gastos_operativos','descripcion_gastos','gastos_extraordinarios','descripcion_gastos_extra'];
}
