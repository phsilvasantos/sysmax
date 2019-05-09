<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animais', function (Blueprint $table) {
            $table->softDeletes();
            $table->bigIncrements('id');
            $table->string('nome');
            $table->enum('sexo', ['Macho', 'Fêmea']);
            $table->enum('porte', ['Mini', 'Pequeno','Médio','Grande','Gigante']);
            $table->string('pelagem')->nullable();
            $table->string('foto')->nullable();
            $table->date('nascimento')->nullable();
            $table->string('especie');

            $table->bigInteger('raca_id')->unsigned();
            $table->foreign('raca_id')
                ->references('id')
                ->on('racas')
                ->onDelete('cascade');

            $table->bigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');

            $table->text('observacoes')->nullable();
            $table->enum('status', ['Vivo', 'Obito'])->default('Vivo');

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
        Schema::dropIfExists('animais');
    }
}
