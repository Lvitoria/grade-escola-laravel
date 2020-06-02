<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\repositories\Grid;
use App\repositories\Discipline;
use Validator;

class GridController extends Controller
{

    private $route = 'grid';

    public function __construct()
    {

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monday    = Grid::GetAllWeek('segunda');
        $tuesday   = Grid::GetAllWeek('terça');
        $wednesday = Grid::GetAllWeek('quarta');
        $thursday  = Grid::GetAllWeek('quinta');
        $friday    = Grid::GetAllWeek('sexta');
        $saturday  = Grid::GetAllWeek('sabado');
        return view('home', compact('monday','tuesday','wednesday', 'thursday', 'friday', 'saturday'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grid = Grid::all();
        $discipline = Discipline::all();

        $routeName = $this->route;
        $page = trans('escola.grid');

        $breadcrumb = [
            (object) ['url' => route('grid.index'), 'title' => trans('escola.home')],
            (object) ['url' => route('grid.create'), 'title' => trans('escola.grid')]
        ];

        return view($routeName . '.create', compact('page', 'routeName', 'breadcrumb', 'discipline', 'grid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grid_idgrid = strip_tags($request->grid);
        $discipline_iddiscipline = strip_tags($request->discipline);
        $classes = strip_tags($request->classes);
        $week =  Grid::GetId('grid', 'id', $grid_idgrid);

        //verifica se ja não existe esta disciplina e esta grade
        $grid_discipline = Grid::GetTwoId($grid_idgrid, $discipline_iddiscipline);
        if (count($grid_discipline) != 0) {
            $request->session()->flash('msg', 'Desculpa, mas esta materia ja vai ser dada neste dia da semana.');
            $request->session()->flash('status', 'error');
            return redirect()->back();
        }

        //verifica se o periodo escolhido já não foi preenchido
        $grid_has_disciplines = Grid::GetAll($grid_idgrid);
        foreach ($grid_has_disciplines as $grid_has_discipline) {
            if ($grid_has_discipline->classes == $classes) {
                $request->session()->flash('msg', 'Este periodo já esta ocupada.');
                $request->session()->flash('status', 'error');
                return redirect()->back();
            }
        }

        //verifica quantas vezes esta disciplina já vai estar na semana, obs tirando os sabados fora
        if ($week->week !== "sabado") {
            $disciplineResult =  Grid::GetId('disciplines', 'id', $discipline_iddiscipline);
            if ($disciplineResult->classWeek >= 4) {
                $request->session()->flash('msg', 'Desculpa, mas esta disciplina, já vai ser dada mais de quatro vezes na semana');
                $request->session()->flash('status', 'error');
                return redirect()->back();
            }
            $disciplineResult->classWeek = strval($disciplineResult->classWeek + 1);
            Grid::updateForID('disciplines', $discipline_iddiscipline, ["classWeek" => $disciplineResult->classWeek]);
        }

        //verifica se tem o 4 periodos disponiveis
        if ($week->period >= 4) {
            $request->session()->flash('msg', 'Este dia da semana já esta cheio');
            $request->session()->flash('status', 'error');
            return redirect()->back();
        }
        $week->period = strval($week->period + 1);
        Grid::updateForID('grid', $grid_idgrid, ["period" => $week->period]);

        $data = [
            'grid_idgrid' => $grid_idgrid,
            'discipline_iddiscipline' => $discipline_iddiscipline,
            'classes' => strip_tags($request->classes)
        ];

        Validator::make($data, [
            'grid_idgrid' => 'required',
            'discipline_iddiscipline' => 'required',
            'classes' => 'required',
        ])->validate();

        if (Grid::insertGridHasDiscipline($data)) {
            $request->session()->flash('msg', 'Inserido com sucesso');
            $request->session()->flash('status', 'success'); // success error notification

        } else {
            $request->session()->flash('msg', 'Falha na operação');
            $request->session()->flash('status', 'error');
        }
        return redirect('/grid');
    }
}
