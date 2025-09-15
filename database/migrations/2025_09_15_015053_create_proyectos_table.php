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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->text('entidad_beneficiaria');
            $table->boolean('es_multidisciplinario')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->timestamp('fecha_presentacion')->nullable();
            $table->timestamp('fecha_aprobacion')->nullable();
            $table->timestamps();

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('modalidad_id')->constrained('modalidades');
            $table->foreignId('estado_id')->constrained('estados');
            $table->foreignId('linea_id')->constrained('lineas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
