@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Generazione lettere
            </h1>
            <div>
                <div class="pull-left">
                    <a href="{{ action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                        class="btn btn-default"><i class="fa fa-fw fa-arrow-left"></i></a>
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>

        <div class="col-md-offset-3 col-md-6">
            <!-- Mostra errori di validazione -->
            @include('common.errors')
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-gear"></i>
                    Opzioni lettera
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="form-control-static"><strong>Tipologia lettera</strong></p>    
                        </div>
                        <div class="col-md-8">
                            {{ Form::select('tipo_lettera', $lettere, null, ['class' => 'form-control', 'id' => 'select-tipo-lettera']) }}
                        </div>
                    </div>
                    
                    @if ($can_choose_logo)
                        <div class="row">
                            <div class="col-md-4">
                                <p class="form-control-static"><strong>Logo</strong></p>    
                            </div>
                            <div class="col-md-8">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="logo" value="0" autocomplete="off" checked> Ely'S
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="logo" value="1" autocomplete="off"> Elisir
                                    </label>
                                </div>
                            </div>
                        </div>  
                    @endif
                    
                    <div class="text-center">
                        <a class="btn btn-primary" id="genera-lettera-btn" href="#"
                            data-url="{{ action('LettereController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'lettera' => '*']) }}">
                            <i class="fa fa-fw fa-bolt"></i>
                            Genera
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
