<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Discipline;
use Validator;

class DisciplineController extends Controller
{
  private $route = 'disciplines';

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $list = Teacher::all();
    $page = trans('escola.disciplines');
    $routeName = $this->route;
    $breadcrumb = [
      (object) ['url' => route('grid.index'), 'title' => trans('escola.home')],
      (object) ['url' => '', 'title' => 'disciplina'],
    ];
    return view('disciplines.create', compact('routeName', 'breadcrumb', 'page', 'list'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $data = [
      'name' => strip_tags($request->name),
      'teacher_idteacher' => strip_tags($request->teacher_idteacher)
    ];

    Validator::make($data, [
      'name' => 'required|string|max:255|unique:disciplines',
      'teacher_idteacher' => 'required|string',
    ])->validate();

    if (Discipline::insert($data)) {
      $request->session()->flash('msg', 'Inserido com sucesso');
      $request->session()->flash('status', 'success'); // success error notification

    } else {
      $request->session()->flash('msg', 'Falha na operação');
      $request->session()->flash('status', 'error');
    }
    return redirect()->back();
  }
}
