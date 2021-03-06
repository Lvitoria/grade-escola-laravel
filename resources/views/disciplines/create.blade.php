@extends('layouts.app')

@section('content')

    @page_component(['col'=>12, 'page'=>__('escola.discipline')])
          @if (count($list) === 0)
              @alert_component(['msg'=>'Não existe professor cadastrado', 'status'=>'error'])
              @endalert_component
          @else
            @alert_component(['msg'=>session('msg'), 'status'=>session('status')])
            @endalert_component

            @breadcrumb_component(['page'=>$page,'items'=>$breadcrumb ?? []])
            @endbreadcrumb_component

            @form_component(['action'=>route("disciplines.store"),'method'=>"POST", 'list' => $list])
              @include('disciplines.form')
              <button class="btn btn-primary btn-lg float-right">Adicionar</button>
            @endform_component
         @endif

    @endpage_component
@endsection
