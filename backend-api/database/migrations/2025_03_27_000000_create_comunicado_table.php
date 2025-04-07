<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria tabela de comunicados
     */

     public function up()
     {
        Schema::create('comunicados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('conteudo');
            $table->date('data_publicacao');
            $table->string('categoria')->nullable();
            $table->string('icone')->nullable();
            $table->boolean('publicado')->default(true);
            $table->foreignId('autor_id')->constrained('user')->onDelete('cascade');
            $table->timestamps();
        });
     }

     /**
      * Remove a tabela de comunicados
      */
       public function down()
       {
        Schema::dropIfExists('comunicados');
       }
};