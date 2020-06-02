<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@hotmail.com',
            'password' => '$2y$10$hWS.iSxGFt6wD3zV.B6an.PQSHVLuzNM1V7Wum40IZ0COniApY1mK'
        ]);
    }
}
