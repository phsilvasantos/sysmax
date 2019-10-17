<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFornecToClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            //
            $table->string('razao_social')->nullable();
            $table->string('inscricao_estadual')->nullable();
            $table->string('categoria')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            //
            $table->dropColumn('razao_social');
            $table->dropColumn('inscricao_estadual');
            $table->dropColumn('categoria');
        });
    }
}
