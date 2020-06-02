@extends('layouts.app')

@section('content')
  @page_component(['col'=>12, 'page'=>__('escola.discipline')])
    @if (count($discipline) === 0 || count($grid) ===0)
          @alert_component(['msg'=>'Por favor, esta faltando informações insira uma disciplina e a semana.', 'status'=>'error'])
          @endalert_component
    @else    
        @alert_component(['msg'=>session('msg'), 'status'=>session('status')])
        @endalert_component
        
        @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
        @endbreadcrumb_component
        
        @form_component(['action'=>route("grid.store"),'method'=>"POST",'grid' => $grid, 'discipline' => $discipline])
        @include('grid.form')
        <button class="btn btn-primary btn-lg float-right">Adicionar</button>
        @endform_component
    @endif

  @endpage_component
@endsection
