<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarCorteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 

        Schema::create('corte', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_corte');            
            $table->integer('ventas_periodo');                   
            $table->integer('gastos_operativos');
            $table->string('descripcion_gastos',1000);
            $table->integer('gastos_extraordinarios');
            $table->string('descripcion_gastos_extra',1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corte');
    }
}
