<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_categoria')->unsigned();
            $table->string('nombre',45);
            $table->string('descripcion',100);
            $table->string('marca',45);
            $table->date('fecha_compra');
            $table->string('num_factura',45);
            $table->integer('num_piezas')->unsigned();
            $table->integer('art_exist')->unsigned();
            $table->integer('iva')->unsigned();
            $table->decimal('precio_compra', 6, 2);
            $table->integer('porcentaje')->unsigned();
            $table->decimal('precio_venta', 6, 2);
            $table->string('ubicacion',45);
            $table->enum('status',['Existente','Vendido'])->default('Existente');
            $table->integer('id_proveedor')->unsigned();
            $table->foreign('id_categoria')->references('id')->on('categorias')->ondelete('cascade');
            $table->foreign('id_proveedor')->references('id')->on('proveedores')->ondelete('cascade');
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
        Schema::dropIfExists('articulos');
    }
}
