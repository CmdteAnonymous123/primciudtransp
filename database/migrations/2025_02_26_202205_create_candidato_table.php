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
        Schema::create('candidato', function (Blueprint $table) {
            $table->smallIncrements('id_candidato'); // SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('nombres', 255);
            $table->unsignedSmallInteger('id_partido')->nullable();

            // Clave foránea a partido con ON UPDATE CASCADE
            $table->foreign('id_partido')
                  ->references('id_partido')
                  ->on('partido')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidato');
    }
};
