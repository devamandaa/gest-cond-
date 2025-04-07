<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; 

return new class extends Migration {
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();                                // Cria uma coluna 'id' auto-incremental primária
            $table->date('data');                        // Cria uma coluna 'data' do tipo DATE (ex: 2025-04-05)
            $table->string('titulo');                    // Cria uma coluna 'titulo' (VARCHAR 255)
            $table->text('descricao')->nullable();       // Cria 'descricao' (tipo TEXT) que pode ser nulo
            $table->time('horario');                     // Cria 'horario' (tipo TIME, ex: 14:00:00)
            $table->timestamps();  
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};