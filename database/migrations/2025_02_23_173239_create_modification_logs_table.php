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
        Schema::create('modification_logs', function (Blueprint $table) {
            $table->id();
            $table->string('table_name'); // Tabla donde ocurrió el cambio
            $table->unsignedBigInteger('record_id'); // ID del registro modificado
            $table->string('column_name')->nullable(); // Campo modificado
            $table->text('old_value')->nullable(); // Valor anterior
            $table->text('new_value')->nullable(); // Valor nuevo
            $table->foreignId('modified_by')->nullable()->constrained('users')->onDelete('set null'); // Usuario que modificó
            $table->timestamps(); // Fecha de creación y modificación
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modification_logs');
    }
};
