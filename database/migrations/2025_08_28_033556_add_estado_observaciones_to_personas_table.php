<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->tinyInteger('estado')->default(1)->after('barrio')->comment('1: Activo, 0: Inactivo');
            $table->text('observaciones')->nullable()->after('estado')->comment('Observaciones adicionales sobre la persona');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn(['estado', 'observaciones']);
        });
    }
};
