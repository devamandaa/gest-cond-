<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('autorizacoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_visitante');
            $table->string('documento')->nullable();
            $table->string('tipo_autorizacao')->default('visitante'); // visitante, prestador etc.
            $table->dateTime('data_hora_entrada')->nullable();
            $table->foreignId('morador_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autorizacoes');
    }
};
