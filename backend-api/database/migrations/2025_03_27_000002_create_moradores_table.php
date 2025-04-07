<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('moradores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique()->nullable(); // deixou opcional
            $table->string('telefone')->nullable();
            $table->string('apartamento');
            $table->string('bloco')->nullable();
            $table->string('unidade')->nullable(); // novo campo (ex: Bloco A - 302), útil pra exibição
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->text('observacoes')->nullable(); // novo campo opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('moradores');
    }
};
