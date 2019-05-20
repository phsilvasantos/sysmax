<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->dateTime('data_recepcao');
            $table->bigInteger('animal_id')->unsigned();
            $table->foreign('animal_id')
                ->references('id')
                ->on('animais')
                ->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->dateTime('data_atendimento')->nullable();
            $table->dateTime('data_encerramento')->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->bigInteger('atendente_id')->unsigned();
            $table->foreign('atendente_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->enum('status',['Aguardando','Em Atendimento','Atendido'])->default('Aguardando');
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
        Schema::dropIfExists('atendimentos');
    }
}
