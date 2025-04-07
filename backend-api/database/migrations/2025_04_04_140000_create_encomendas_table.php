<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncomendasTable extends Migration 
{
    /**
     * 
     */

     public function up():void
     {
        Schema::create('encomendas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_morador');
            $table->string('bloco')->nullable();
            $table->string('apartamento')->nullable();
            $table->string('descricao')->nullable();
            $table->timestamp('data_chegada')->nullable();
            $table->string('foto')->nullable(); //caminho da imagem no storge
            $table->string('transportadora')->nullable();
            $table->string('status')->default('aguardando-retirada');
            $table->timestamps(); 
        });
     }

     public function down(): void{
        Schema::dropIfExists('encomendas');
     }
}