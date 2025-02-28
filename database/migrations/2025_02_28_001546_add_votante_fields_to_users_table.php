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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cedula', 50)->unique()->after('username');
            $table->date('fecha_nac')->nullable()->after('cedula');
            $table->enum('lugar_emision', ['SC', 'LP', 'OR', 'CB', 'TA', 'BE', 'PA', 'CH', 'PO'])->nullable()->after('fecha_nac');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cedula', 'fecha_nac', 'lugar_emision']);
        });
    }
};
