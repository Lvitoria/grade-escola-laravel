<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\repositories\Teacher;
use Validator;

class TeacherController extends Controller
{

  private $route = 'teachers';
  private $paginate = 2;
  private $search = ['name'];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $columnList = [
      'id' => '#',
      'name' => trans('escola.name'),
      'status' => 'status'
    ];
    $routeName = $this->route;
    $page = trans('escola.teacher_list');
    $breadcrumb = [
      (object) ['url' => route('grid.index'), 'title' => trans('escola.home')],
      (object) ['url' => '', 'title' => trans('escola.list', ['page' => $page])],
    ];
    $search = "";
    if (isset($request->search)) {
      $search = $request->search;
      $list = Teacher::findWhereLike($this->search, $search, 'id', 'DESC');
    } else {
      $list = Teacher::paginate($this->paginate);
    }
    return view($routeName . '.index', compact('list', 'search', 'page', 'routeName', 'columnList', 'breadcrumb'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //

    $routeName = $this->route;
    $page = trans('escola.teacher_list');
    $page_create = trans('escola.teacher');

    $breadcrumb = [
      (object) ['url' => route('grid.index'), 'title' => trans('escola.home')],
      (object) ['url' => route('teachers.index'), 'title' => trans('escola.list', ['page' => $page])],
      (object) ['url' => '', 'title' => trans('escola.create_teacher', ['page' => $page_create])],
    ];
    //pasta.view
    return view($routeName . '.create', compact('page', 'page_create', 'routeName', 'breadcrumb'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //

    $starDate = strip_tags($request->holidayStart);
    $endDate = strip_tags($request->holidayEnd);
    if (!empty($starDate) || !empty($endDate)) {
      if ($starDate <  date("yy-m-d")) {
        $request->session()->flash('msg', 'Data de inicio das férias não pode ser menor que a data atual.');
        $request->session()->flash('status', 'notification'); // success error notification
        return redirect()->back();
      }

      if ($starDate >= $endDate) {
        $request->session()->flash('msg', 'Data de inicio das férias não pode ser menor ou igual da data de final das férias.');
        $request->session()->flash('status', 'notification'); // success error notification
        return redirect()->back();
      }
    }

    $data = [
      'name' => strip_tags($request->name),
      'status' => 'titular',
      'holidayStart' => $starDate,
      'holidayEnd' => $endDate
    ];

    Validator::make($data, [
      'name' => 'required|string|max:255',
      'holidayStart' => 'nullable|date',
      'holidayEnd' => 'nullable|date',
    ])->validate();

    Teacher::insert($data);
    $request->session()->flash('msg', 'Inserido com sucesso');
    $request->session()->flash('status', 'success'); // success error notification
    return redirect()->back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
