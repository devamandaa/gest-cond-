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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_visitante');
            $table->string('documento');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('morador_id');
            $table->timestamp('data_entrada')->nullable();
            $table->timestamp('data_saida')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
