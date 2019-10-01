<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescricaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescricaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->unsignedBigInteger('empresa_id');
            //$table->foreign('empresa_id')->references('id')->on('atendimentos')->onDelete('cascade');
            $table->unsignedBigInteger('atendimento_id');
            //$table->foreign('atendimento_id')->references('id')->on('atendimentos')->onDelete('cascade');
            $table->unsignedBigInteger('item_prescricao_id');
            //$table->foreign('item_prescricao_id')->references('id')->on('itens_prescricaos')->onDelete('cascade');
            $table->unsignedBigInteger('vet_id');
            //$table->foreign('vet_id')->references('id')->on('users')->onDelete('cascade');
            $table->time('recorrencia');
            $table->dateTime('inicial');
            $table->dateTime('final');
            $table->string('via')->nullable();
            $table->string('fluido')->nullable();
            $table->string('equipo')->nullable();
            $table->string('volume')->nullable();
            $table->string('velocidade')->nullable();
            $table->string('suplemento')->nullable();


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
        Schema::dropIfExists('prescricaos');
    }
}
