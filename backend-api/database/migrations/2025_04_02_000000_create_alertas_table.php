<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->id(); // ID único
            $table->string('mensagem'); // Texto do alerta
            $table->enum('tipo', ['urgente', 'comunicado', 'aviso'])->default('aviso'); // Tipo de alerta
            $table->date('data')->nullable(); // Data relacionada ao alerta
            $table->timestamps(); // created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};
