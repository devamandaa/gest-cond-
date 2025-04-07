<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('encomendas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_rastreio')->nullable();
            $table->string('descricao')->nullable();
            $table->dateTime('recebido_em')->nullable();
            $table->foreignId('morador_id')->constrained()->onDelete('cascade');
            $table->boolean('entregue')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encomendas');
    }
};
