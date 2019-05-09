<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->softDeletes();
            $table->bigIncrements('id');
            $table->string('categoria')->nullable();
            $table->text('descricao')->nullable();
            $table->string('categoria_type');
            $table->timestamps();
        });


        Schema::create('categoria_cliente', function (Blueprint $table) {
            $table->softDeletes();
            $table->bigIncrements('id');
            $table->integer('categoria_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
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
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('categoria_cliente');
    }
}
