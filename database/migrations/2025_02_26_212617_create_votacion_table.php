<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('votacion', function (Blueprint $table) {
            $table->dateTime('fecha_hora');
            $table->string('ubicacion', 255)->nullable();
            $table->string('ip_origen', 45)->nullable();
            $table->unsignedSmallInteger('id_eleccion');
            $table->unsignedBigInteger('id');
            $table->unsignedSmallInteger('id_candidato')->nullable();
            
            $table->primary(['id_eleccion', 'id']);
            $table->foreign('id_candidato')->references('id_candidato')->on('candidato')->onUpdate('cascade');
            $table->foreign('id_eleccion')->references('id_eleccion')->on('eleccion')->onUpdate('cascade');
            $table->foreign('id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votacion');
    }
};
