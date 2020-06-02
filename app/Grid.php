<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Grid extends Model
{
    protected $table = "grid";

    //Quers do N pra N
    public static function insertGridHasDiscipline(array $data)
    {
        return DB::table('grid_has_discipline')->insert($data);
    }

    public static function GetTwoId(int $grid_idgrid, int $discipline_iddiscipline)
    {
        return DB::table('grid_has_discipline')->where('grid_idgrid', '=', $grid_idgrid)->where('discipline_iddiscipline', '=', $discipline_iddiscipline)->get();
    }

    public static function GetAll(int $grid_idgrid)
    {
        return DB::table('grid_has_discipline')->where('grid_idgrid', '=', $grid_idgrid)->get();
    }

    public static function GetId(string $tabela, string  $coluna, string $id)
    {
        return DB::table($tabela)->where($coluna, '=', $id)->get()->first();
    }

    public static function updateForID(string $tabela, string $id, array $array)
    {
        return DB::table($tabela)->where('id', $id)->update($array);
    }

    public static function GetAllWeek(string $week)
    {
        return DB::table('teachers')
            ->join('disciplines', 'teachers.id', '=', 'disciplines.teacher_idteacher')
            ->join('grid_has_discipline', 'disciplines.id', '=', 'grid_has_discipline.discipline_iddiscipline')
            ->join('grid', 'grid_has_discipline.grid_idgrid', '=', 'grid.id')
            ->where('grid.week', $week)
            ->select('grid.*', 'teachers.*', 'disciplines.name as discipline', 'grid_has_discipline.classes')
            ->orderBy('grid_has_discipline.classes', 'asc')
            ->get();
    }
}
