<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 191)->unique();
            $table->string('cedula', 50)->unique();
            $table->date('fecha_nac')->nullable();
            $table->enum('lugar_emision', ['SC', 'LP', 'OR', 'CB', 'TA', 'BE', 'PA', 'CH', 'PO'])->nullable();
            $table->string('location')->nullable();            
            $table->unsignedSmallInteger('id_partido')->nullable();
            $table->string('name', 191);
            $table->string('email', 191)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            
            $table->foreign('id_partido')->references('id_partido')->on('partido');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

