@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Modifica fattura esistente
            </h1>
            <div>
                <div class="pull-left">
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
                    Dati fattura
                </div>
                <div class="panel-body">
                    {!! Form::model($fattura, ['action' => ['FattureController@update',
                        'cliente' => $fattura->pratica->cliente,
                        'pratica' => $fattura->pratica,
                        'fattura' => $fattura], 'method' => 'put',
                        'class' => 'form-horizontal']) !!}
                        <!--<div class="form-group">-->
                        <!--    {!! Form::label('filiale', 'Filiale', ['class' => 'col-md-4 control-label']) !!}-->
                        <!--    <div class="col-md-8">-->
                        <!--        <div class="btn-group" data-toggle="buttons">-->
                        <!--            <label class="btn btn-default active">-->
                        <!--                <input type="radio" name="appartenenza" value="1" autocomplete="off" checked> Ely'S-->
                        <!--            </label>-->
                        <!--            <label class="btn btn-default">-->
                        <!--                <input type="radio" name="appartenenza" value="2" autocomplete="off"> Elisir-->
                        <!--            </label>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>  -->
                        
                        <div class="form-group">
                            <div class="col-md-4">
                                <strong class="pull-right">Filiale</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $fattura->nomeFiliale }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-4">
                                <strong class="pull-right">Numero fattura</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $fattura->numero }}
                            </div>
                        </div>
    
                        <div class="form-group">
                            {!! Form::label('dettaglio_prestazione', 'Dettaglio prestazione', ['class' => 'col-md-4 control-label']) !!}    
                            <div class="col-md-8">
                                {!! Form::text('dettaglio_prestazione', null, ['class' => 'form-control col-md-8']) !!}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('importo_netto', "Importo netto" , ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                <div class="input-group">
                                    {!! Form::number('importo_netto', null, ['class' => 'form-control', 'step' => 'any', 'min' => '0']) !!}
                                    <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('importo_esente', "Importo esente" , ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                <div class="input-group">
                                    {!! Form::number('importo_esente', null, ['class' => 'form-control', 'step' => 'any', 'min' => '0']) !!}
                                    <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                                </div>
                            </div>
                        </div>
    
                        <div class="text-center">
                            <button class="btn btn-primary">
                                <i class="fa fa-fw fa-pencil"></i>
                                Conferma modifiche
                            </a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
