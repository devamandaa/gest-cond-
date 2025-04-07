<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void 
     
    {
        Schema::create('funcionarios', function (Blueprint $table){
            $table->id();
            $table->string('nome');
            $table->string('cargo');
            $table->string('status');
            $table->string('foto')->nullable(); //URL ou nome do arquivo da foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};