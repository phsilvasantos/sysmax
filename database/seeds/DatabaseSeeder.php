<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(MunicipioTableSeeder::class);
         $this->call(ClienteTableSeeder::class);
         $this->call(ServicoTableSeeder::class);
    }
}
