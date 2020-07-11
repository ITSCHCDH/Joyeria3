<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EstadoCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('estado_cuenta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_inversionista')->unsigned()->nullable();
            $table->enum('concepto', ['utilidad', 'inversion','retiro']);
            $table->integer('monto');
            $table->date('fecha');
            $table->string('corte',20);

            $table->foreign('id_inversionista')->references('id')->on('inversionistas')->onDelete('cascade');
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
        Schema::dropIfExists('estado_cuenta');
    }
}
