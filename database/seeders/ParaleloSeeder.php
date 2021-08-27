<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paralelo;

class ParaleloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paralelo::create(['id' => '1','nombre' => 'A']);
        Paralelo::create(['id' => '2','nombre' => 'B']);
        Paralelo::create(['id' => '3','nombre' => 'C']);
        Paralelo::create(['id' => '4','nombre' => 'D']);
        Paralelo::create(['id' => '5','nombre' => 'E']);
        Paralelo::create(['id' => '6','nombre' => 'F']);
    }
}
