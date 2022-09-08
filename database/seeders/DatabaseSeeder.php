<?php

namespace Database\Seeders;

use App\Models\Funcionario;
use App\Models\User;
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
        // User::factory(10)->create();
        Funcionario::factory(5)->create();
    }
}
