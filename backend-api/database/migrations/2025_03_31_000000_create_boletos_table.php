<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up()
    {
        Schema::create('boletos', function(Blueprint $table) {
            $table->id();

            $table->string('mes-ano'); // Ex: "março/2025"

            $table->decimal('valor', 10, 2); // Valor do boleto

            $table->date('data_vencimento');

            $table->string('status')->default('pendente'); //pendente, pago, vencido, renegociado

            $table->date('data_pagamento')->nullable();

            $table->string('comprovante')->nullable(); //caminho do arquivo enviado

            $table->unsignedBiginterger('morador_id')->nullable(); //FK (opcional se usar moradores)

            $table->text('descricao')->nullable();

            $table->timestamps(); //created_at e updated_at

        });
    }

    public function down()
    {
        schema::dropIfExists('boletos');
    }
};