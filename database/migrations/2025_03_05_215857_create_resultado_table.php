<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('resultado', function (Blueprint $table) {
            $table->id('id_resultado');
            $table->integer('votos')->default(0);
            $table->unsignedSmallInteger('id_eleccion');
            $table->unsignedSmallInteger('id_candidato');
            
            $table->foreign('id_eleccion')->references('id_eleccion')->on('eleccion');
            $table->foreign('id_candidato')->references('id_candidato')->on('candidato');
        });
    }

    public function down()
    {
        Schema::dropIfExists('resultado');
    }
};