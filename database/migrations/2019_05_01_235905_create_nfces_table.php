<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNfcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfces', function (Blueprint $table) {
            $table->softDeletes();
            $table->bigIncrements('id');
            $table->unsignedBigInteger('venda_id');
            $table->foreign('venda_id')->references('id')->on('vendas')->ondelete('cascade');

            $table->dateTime('data_venda')->nullable();
            $table->string('xml_assinado')->nullable();
            $table->string('recibo')->nullable();
            $table->string('xml_autorizado')->nullable();
            $table->double('valor',8,2)->nullable();
            $table->string('nfce_pdf')->nullable();
            $table->string('status')->nullable();
            $table->string('mesAno')->nullable();
            $table->string('arquivo')->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
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
        Schema::dropIfExists('nfces');
    }
}
