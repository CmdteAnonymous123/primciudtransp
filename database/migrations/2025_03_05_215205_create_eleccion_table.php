<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('eleccion', function (Blueprint $table) {
            $table->smallIncrements('id_eleccion');
            $table->string('nombre');
            $table->date('fecha_ini');
            $table->date('fecha_fin');
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleccion');
    }
};
