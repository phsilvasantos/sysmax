<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecebersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receber', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->string('resumo');
            $table->string('documento')->nullable();
            $table->text('descricao')->nullable();
            $table->date('data_vencimento');
            $table->date('data_emissao')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->float('valor_documento')->nullable();
            $table->float('valor_original');
            $table->float('valor_desconto')->nullable();
            $table->float('valor_juros')->nullable();
            $table->float('valor_multa')->nullable();
            $table->float('valor_pago')->nullable();
            $table->string('status')->nullable();
            $table->string('parcelas')->nullable();
            $table->string('numero_parcela')->nullable();
            $table->text('observacao')->nullable();
            $table->text('setor')->nullable();
            $table->text('imagem')->nullable();


            $table->unsignedBigInteger('receber_id')->nullable();
            $table->foreign('receber_id')->references('id')->on('receber');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');

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
        Schema::dropIfExists('receber');
    }
}
