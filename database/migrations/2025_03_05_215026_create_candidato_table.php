<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('candidato', function (Blueprint $table) {
            $table->smallIncrements('id_candidato');
            $table->string('nombres');
            $table->unsignedSmallInteger('id_partido')->nullable();
            
            $table->foreign('id_partido')->references('id_partido')->on('partido');
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidato');
    }

};
