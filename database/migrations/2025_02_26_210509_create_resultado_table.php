<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado', function (Blueprint $table) {
            $table->id('id_resultado'); // INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->integer('votos')->default(0);
            $table->unsignedSmallInteger('id_eleccion'); // SMALLINT UNSIGNED
            $table->unsignedSmallInteger('id_candidato'); // SMALLINT UNSIGNED

            // Definición de claves foráneas
            $table->foreign('id_eleccion')->references('id_eleccion')->on('eleccion')->onUpdate('cascade');
            $table->foreign('id_candidato')->references('id_candidato')->on('candidato')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultado');
    }
};
