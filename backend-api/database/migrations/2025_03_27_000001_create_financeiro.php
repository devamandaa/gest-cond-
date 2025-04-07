<?php

use illuminate\Database\Migrations\Migration;
use illuminate\Database\Schema\Blueprint;
use illuminate\Support\facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('financeiro', function (Blueprint $table) {
            $table->id();

            $table->string('tipo');// receita ou despesa

            $table->string('categoria'); //manutenção, aluguel, água, etc.

            $table->decimal('valor', 10, 2);

            $table->date('data');

            $table->text('descricao')->nullable();

            $table->string('status')->default('pendente'); //campo novo 

            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('financeiros');
    }
};