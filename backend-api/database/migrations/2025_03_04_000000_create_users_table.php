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
        Schema::create('ordens_servico', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->enum('prioridade', ['baixa', 'media', 'alta'])->default('baixa');
            $table->string('responsavel')->nullable();
            $table->enum('status', ['pendente', 'em_andamento', 'concluida', 'cancelada'])->default('pendente');
            $table->date('date')->nullable();
            $table->string('anexo')->nullable();
            $table->timestamps(); 
        });

     }

     /**
      * 
      */

      public function down(): void 
      {
        Schema::fropIfExists('ordens_servico');
      }
};