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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('nombre_original', 255);
            $table->string('ruta', 255);
            $table->unsignedBigInteger('size');
            $table->string('mime_type', 100)->nullable();
            $table->string('titulo', 255)->nullable();
            $table->text('descripcion')->nullable();
            $table->boolean('es_obligatorio')->nullable();
            $table->date('fecha_documento')->nullable();
            $table->enum('estado', ['en_revision', 'pendiente', 'revisado', 'aprobado', 'observado', 'rechazado'])->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamp('uploaded_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->foreignId('proyecto_id')->constrained('proyectos');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->foreignId('categoria_id')->constrained('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
