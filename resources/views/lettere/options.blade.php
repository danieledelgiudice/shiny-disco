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
                            <select name="tipo_lettera" class="form-control" data-selecttype="lettere" id="select-tipo-lettera">
                            @foreach ($lettere as $k => $lettera)
                                <option value="{{ $k }}" data-data='{{ json_encode(['requires' => $lettera['requires']]) }}'>{{ $lettera['name'] }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    
                    @if ($can_choose_logo)
                        <div class="row opzioni-lettere hide" data-optionid="1">
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
                    
                    <div class="opzioni-lettere hide" data-optionid="2">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="form-control-static"><strong>Totale</strong></p>    
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input class="form-control" name="totale" type="number" value="0.00">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-4">
                                <p class="form-control-static"><strong>Onorari</strong></p>    
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input class="form-control" name="onorari" type="number" value="0.00">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-4">
                                <p class="form-control-static"><strong>Spese varie</strong></p>    
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input class="form-control" name="varie" type="number" value="0.00">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <p class="form-control-static"><strong>Nascondi percentuali</strong></p>    
                            </div>
                            <div class="col-md-8">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="nascondi_percentuali" value="1" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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
