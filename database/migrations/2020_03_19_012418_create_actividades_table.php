<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('titulo');
            $table->text('instrucciones')->nullable();
            $table->integer('puntos')->nullable();
            $table->date('fecha_de_entrega')->nullable();
             $table->String('url')->nullable();
            $table->String('archivo')->nullable();
            $table->String('tipo')->nullable();
            $table->integer('tema_id');
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
        Schema::dropIfExists('actividades');
    }
}
