<link rel="stylesheet" href="<?php echo asset('css/grid.css')?>" type="text/css">

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Seja bem vindo</div>

                <div class="card-body">
                    @alert_component(['msg'=>session('msg'), 'status'=>session('status')])
                    @endalert_component

                    <div class="tc-mobile-wrap space-top">
                        <div class="control-bar">
                            <div>
                                <h4 class="title">Grade Curricular:</h4>
                            </div>
                        </div>
                        <div class="grid-week">
                            @box_component(['weeks'=>$monday,'title'=> 'Segundo','position'=>2])
                            @endbox_component
                            
                            @box_component(['weeks'=>$tuesday,'title'=> 'Terça','position'=>3])
                            @endbox_component
                            
                            @box_component(['weeks'=>$wednesday,'title'=> 'Quarta','position'=>4])
                            @endbox_component
                            
                            @box_component(['weeks'=>$thursday,'title'=> 'Quinta','position'=>5])
                            @endbox_component
                            
                            @box_component(['weeks'=>$friday,'title'=> 'Sexta','position'=>6])
                            @endbox_component
                            
                            @box_component(['weeks'=>$saturday,'title'=> 'Sabado','position'=>7])
                            @endbox_component
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection
