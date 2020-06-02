<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teacher extends Model
{
    public static function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC')
    {      
      return DB::table('teachers')->orderBy($column,$order)->paginate($paginate);
    }

    public static function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC')
    {
       $query = DB::table('teachers');

       foreach ($columns as $key => $value) {
          $query = $query->orWhere($value,'like','%'.$search.'%');
       }

       return $query->orderBy($column,$order)->get();
    }
}
