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
        Schema::create('eleccion_candidato', function (Blueprint $table) {
            $table->unsignedSmallInteger('id_eleccion');
            $table->unsignedSmallInteger('id_candidato');
            
            // Clave primaria compuesta
            $table->primary(['id_eleccion', 'id_candidato']);
            
            // Claves foráneas
            $table->foreign('id_candidato', 'fk_candidato')
                ->references('id_candidato')
                ->on('candidato')
                ->onUpdate('cascade')
                ->onDelete('restrict');
                
            $table->foreign('id_eleccion', 'fk_eleccion')
                ->references('id_eleccion')
                ->on('eleccion')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleccion_candidato');
    }
};