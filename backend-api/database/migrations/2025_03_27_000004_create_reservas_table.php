<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    /**
     * Cria a tabela reservas
     */

     public function up()
     {
        Schema::create('reservas', function (blueprint $table) {
            $table->id();
            $table->string('area_comum');
            $table->date('data');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->string('morador');
            $table->string('unidade')->nullable();
            $table->text('observacoes')->nullable(); 
            $table->string('status')->default('pendente');
            $table->timesTamp('data_confirmacao')->nullable();
            $table->timesTamps(); 
            

        });
     }

     /**
      * Remove a tabela reservas se necessário
    */

    public function down()
    {
        schema::dropIfExists('reservas');
    }
};