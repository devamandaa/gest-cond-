<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id(); // ID único da tarefa
            $table->string('titulo'); // Título da tarefa
            $table->enum('prioridade', ['Baixa', 'Média', 'Alta'])->default('Média'); // Nível de prioridade
            $table->boolean('concluida')->default(false); // Status da tarefa
            $table->timestamps(); // created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
