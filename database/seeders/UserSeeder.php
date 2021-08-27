<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1        
        User::create(['login' => 'barrientos','password' => bcrypt('123456'),'rol_usuario' => 'administrador',]);
        // 2
        User::create(['login' => 'mayte','password' => bcrypt('123456'),'rol_usuario' => 'secretaria',]);
        //Profesores
        User::create(['login' => 'leonely','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'milton','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'alex','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'adan','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'aileen','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'alexander','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'yhordi','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'alexi','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'victor','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'brayan','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'jose','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'michell','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'alejandro','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'ronaldo','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'bruno','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'armando','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'francisco','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'alejandra','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
        User::create(['login' => 'mario','password' => bcrypt('123456'),'rol_usuario' => 'profesor',]);
    }
}
