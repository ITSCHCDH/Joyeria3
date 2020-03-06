<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarArtVendidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('art_vendidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('folio_venta')->unsigned();
            $table->bigInteger('id_articulo')->unsigned();
            $table->double('precio', 6, 2);
            $table->integer('cantidad')->unsigned();

            $table->foreign('id_articulo')->references('id')->on('articulos')->ondelete('cascade');
            $table->foreign('folio_venta')->references('id')->on('ventas');            
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
        Schema::dropIfExists('art_vendidos');
    }
}
