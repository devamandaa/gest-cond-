<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('whatsapps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('morador_id')->nullable();
            $table->string('telefone', 20);
            $table->text('mensagem');
            $table->timestamps();

            $table->foreign('morador_id')->references('id')->on('moradores')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapps');
    }
};
