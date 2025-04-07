<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
  {
    Schema::create('boletos', function (Blueprint $table) {
        $table->id();
        $table->string('descricao');
        $table->decimal('valor', 10, 2);
        $table->date('vencimento');
        $table->boolean('pago')->default(false);
    });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
