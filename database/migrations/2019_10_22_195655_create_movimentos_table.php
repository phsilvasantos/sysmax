<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('conta_id');
            $table->unsignedBigInteger('user_id');
            $table->date('data');
            $table->enum('tipo',['crédito','débito']);
            $table->float('valor');
            $table->string('historico')->nullable();
            $table->string('documento')->nullable();
            $table->unsignedBigInteger('receber_id')->nullable();
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
        Schema::dropIfExists('movimentos');
    }
}
