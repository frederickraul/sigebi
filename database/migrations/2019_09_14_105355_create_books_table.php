<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero')->unique();
            $table->String('photo')->nullable();
            $table->String('iniciales',10);
            $table->String('clasificacion');
            $table->String('titulo');
            $table->String('subtitulo')->nullable();
            $table->String('paginas')->nullable();
            $table->integer('autor')->nullable();
            $table->String('ejemplar',10)->nullable();
            $table->String('volumen')->nullable();
            $table->integer('estado');
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
        Schema::dropIfExists('books');
    }
}
