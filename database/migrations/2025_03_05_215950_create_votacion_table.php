<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('votacion', function (Blueprint $table) {
            $table->datetime('fecha_hora');
            $table->string('ubicacion')->nullable();
            $table->string('ip_origen', 45)->nullable();
            $table->unsignedSmallInteger('id_eleccion');
            $table->unsignedBigInteger('id');
            $table->unsignedSmallInteger('id_candidato')->nullable();
            
            $table->primary(['id_eleccion', 'id']);
            
            $table->foreign('id_eleccion')->references('id_eleccion')->on('eleccion');
            $table->foreign('id')->references('id')->on('users');
            $table->foreign('id_candidato')->references('id_candidato')->on('candidato');
        });
    }

    public function down()
    {
        Schema::dropIfExists('votacion');
    }
};
