<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('clientes')->insert([
            'nome'=>'CLIENTE PADRÃO',
            'sexo'=>'M',
            'tipo'=>'Fisica'
            ]);

        DB::table('forma_pagamentos')->insert([
            'nome'=>'Dinheiro',
            'tPag' => '01'
               ]);

        DB::table('forma_pagamentos')->insert([
            'nome'=>'Crédito',
            'tPag' => '03',
            'tBand' => '01'
        ]);

        DB::table('categorias')->insert([
            'categoria'=>'Consultas',
            'categoria_type'=>'produtos'

        ]);

        DB::table('categorias')->insert([
            'categoria'=>'Associado',
            'categoria_type'=>'clientes'

        ]);

        DB::table('produtos')->insert([
            'nome'=>'Consulta',
            'tipo'=>'servico',
            'custo'=>'150.00',
            'preco'=>'250.00',
            'categoria_id'=>'1',
            'codigo_cfop' => '5933',
            'codigo_ncm' => '00'

        ]);



    }
}
