<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GridTableSeeder extends Seeder
{
    static $weeks = [
        'segunda',
        'terça',
        'quarta',
        'quinta',
        'sexta',
        'sabado'
    ];
    public function run()
    {
        foreach (self::$weeks as $week) {
            DB::table('grid')->insert([
                'week' => $week
            ]);
        }
    }
}
