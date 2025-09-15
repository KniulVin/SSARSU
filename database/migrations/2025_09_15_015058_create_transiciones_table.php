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
        Schema::create('transiciones', function (Blueprint $table) {
            $table->id();
            $table->string('estado_origen', 50);
            $table->string('estado_destino', 50);
            $table->string('rol_requerido', 100);
            $table->string('permiso_requerido', 100);
            $table->foreignId('modalidad_id')->constrained('modalidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transiciones');
    }
};
