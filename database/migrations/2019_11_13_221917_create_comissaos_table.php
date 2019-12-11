<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComissaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comissoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('produto_id');
            $table->string('nome')->nullable();
            $table->float('valor')->nullable();
            $table->float('percentual')->nullable();
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
        Schema::dropIfExists('comissoes');
    }
}
