<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::table('ocorrencias', function (Blueprint $table) {
        $table->string('tipo')->nullable();
        $table->string('unidade')->nullable();
        $table->string('prioridade')->default('média');
        $table->timestamp('data_resolucao')->nullable();
        $table->text('resposta_admin')->nullable();
        $table->string('anexo')->nullable();
    });
}

public function down()
{
    Schema::table('ocorrencias', function (Blueprint $table) {
        $table->dropColumn([
            'tipo',
            'unidade',
            'prioridade',
            'data_resolucao',
            'resposta_admin',
            'anexo'
        ]);
    });
}

};
    