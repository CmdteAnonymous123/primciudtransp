<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('extranjeros', function (Blueprint $table) {
            $table->id('id_extranjeros');
            $table->unsignedInteger('votos')->default(0);
            $table->string('pais', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extranjeros');
    }
};
