<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNfceDetalhesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfce_detalhes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('venda_id');
            $table->foreign('venda_id')->references('id')->on('vendas')->ondelete('cascade');
            $table->unsignedBigInteger('nfce_id');
            $table->foreign('nfce_id')->references('id')->on('nfces')->ondelete('cascade');
            $table->dateTime('data_hora')->nullable();
            $table->string('status')->nullable();
            $table->text('descricao')->nullable();
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
        Schema::dropIfExists('nfce_detalhes');
    }
}
