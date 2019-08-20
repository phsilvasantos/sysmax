<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leitos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->enum('porte', ['Pequeno','Médio','Grande']);
            $table->date('vigencia_inicial');
            $table->string('status')->nullable();

            $table->unsignedBigInteger('setor_id');
//            $table->foreign('setor_id')
//                ->references('id')
//                ->on('setores');

            $table->unsignedBigInteger('empresa_id');
            //$table->foreign('empresa_id')->references('id')->on('empresas');

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
        Schema::dropIfExists('leitos');
    }
}
