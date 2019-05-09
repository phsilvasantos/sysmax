<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->softDeletes();
            $table->bigIncrements('id');
            $table->string('nome_fantasia');
            $table->string('razao_social');
            $table->string('sigla')->nullable();
            $table->string('cnpj');
            $table->string('ie')->nullable();
            $table->string('im')->nullable();
            $table->string('telefone')->nullable();
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('referencia')->nullable();
            $table->string('observacoes')->nullable();

            $table->string('certificado')->nullable();
            $table->date('validade_certificado')->nullable();
            $table->string('senha')->nullable();
            $table->string('csc')->nullable();
            $table->string('csc_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('versao')->default('4.0');
            $table->string('cUF')->default('DF');
            $table->string('natOp')->default('Venda');
            $table->enum('mod',[55,65])->default('65');
            $table->string('serie')->default(1);
            $table->string('nNF')->default(1);
            $table->enum('tpNF',[0,1])->default('1');
            $table->enum('idDest',[1,2,3])->default('1');
            $table->string('cMunFG')->nullable();
            $table->enum('tpImp',[1,2,3,4,5])->default('4');
            $table->enum('tpEmis',[1,2,3,4,5,6,7,9])->default('1');
            $table->enum('tpAmb',[1,2])->default('2');
            $table->enum('finNFe',[1,2,3,4])->default('1');
            $table->enum('indFinal',[0,1])->default('1');
            $table->enum('indPres',[0,1,2,3,4,9])->default('1');
            $table->dateTime('dhCont')->nullable();
            $table->string('xJust')->nullable();
            $table->enum('CRT',[1,2,3])->default('1');
            $table->string('CNAE')->nullable();
            $table->string('cListServ')->nullable();
            $table->enum('cRegTrib',[1,2,3,4,5,6])->default(6);

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
        Schema::dropIfExists('empresas');
    }
}
