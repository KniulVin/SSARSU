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
        Schema::create('constancias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->enum('tipo', ['participacion', 'organizacion', 'validacion', 'aprobacion']);
            $table->string('archivo', 255);
            $table->date('fecha_emision');
            $table->foreignId('participante_id')->constrained('participantes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constancias');
    }
};
