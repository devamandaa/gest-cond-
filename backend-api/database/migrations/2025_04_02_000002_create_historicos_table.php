<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table->id();                         // ID único do histórico
            $table->string('descricao');          // Texto descritivo do que ocorreu
            $table->date('data');                 // Data em que ocorreu
            $table->timestamps();                 // created_at e updated_at automáticos
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historicos');
    }
};
