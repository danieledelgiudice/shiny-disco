@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Crea nuova fattura
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
                    Dati fattura
                </div>
                <div class="panel-body">
                    {!! Form::model($fattura, ['action' => ['FattureController@store', 'cliente' => $pratica->cliente, 'pratica' => $pratica], 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('filiale', 'Filiale', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="appartenenza" value="1" autocomplete="off" checked> Ely'S
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="appartenenza" value="2" autocomplete="off"> Elisir
                                    </label>
                                </div>
                            </div>
                        </div>  
    
                        <div class="form-group">
                            {!! Form::label('numero', 'Numero fattura', ['class' => 'col-md-4 control-label']) !!}    
                            <div class="col-md-8">
                                {!! Form::number('numero', null, ['class' => 'form-control col-md-8', 'min' => '1', 'placeholder' => 'Lasciare vuoto per assegnare automaticamente' ]) !!}
                            </div>
                        </div>
    
                        <div class="form-group">
                            {!! Form::label('dettaglio_prestazione', 'Dettaglio prestazione', ['class' => 'col-md-4 control-label']) !!}    
                            <div class="col-md-8">
                                {!! Form::text('dettaglio_prestazione', null, ['class' => 'form-control col-md-8']) !!}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('data_emissione', "Data di emissione" , ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                <div class="input-group date">
                                    {!! Form::text('data_emissione', format_date($fattura->data_emissione), ['class' => 'form-control date-control']) !!}
                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                </div>
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
                                <i class="fa fa-fw fa-plus"></i>
                                Crea fattura
                            </a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
