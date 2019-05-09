<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->softDeletes();
            $table->bigIncrements('id');
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->enum('tipo',['produto','servico']);
            $table->string('codigo_barras')->nullable();
            $table->string('unidade')->nullable();
            $table->string('codigo_ncm')->nullable();
            $table->string('codigo_extipi')->nullable();
            $table->string('codigo_cfop')->nullable();
            $table->double('custo',8,2)->nullable();
            $table->double('preco',8,2);
            $table->string('controla_estoque')->nullable();
            $table->string('estoque_minimo')->nullable();
            $table->string('estoque_maximo')->nullable();
            $table->string('estoque_atual')->nullable();
            $table->string('bloqueado')->nullable();
            $table->text('observacoes')->nullable();

            $table->bigInteger('categoria_id')->unsigned();
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
        Schema::dropIfExists('produtos');
    }
}
