<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('venda_id');
            $table->foreign('venda_id')->references('id')->on('vendas')->ondelete('cascade');
            $table->unsignedBigInteger('forma_pagamento_id');
            $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamentos')->ondelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');
            $table->float('valor',8,2);
            $table->integer('parcelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
