<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pregunta', function (Blueprint $table) {
            $table->smallIncrements('id_pregunta');
            $table->string('enunciado');
            $table->string('respuesta');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pregunta');
    }
};
