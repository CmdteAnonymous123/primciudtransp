<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('partido', function (Blueprint $table) {
            $table->smallIncrements('id_partido');
            $table->char('sigla', 255);
            $table->string('nombre');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partido');
    }

};
