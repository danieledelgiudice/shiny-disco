@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Inserimento nuovo documento
            </h1>
            <div>
                <div class="pull-left">
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>

        @include('common.errors')

        <div class="panel panel-default col-md-6 col-md-offset-3">
            <div class="panel-body">
                {!! Form::open(['action' => ['DocumentiController@store', 'cliente' => $cliente, 'pratica' => $pratica],
                'files' => true, 'class' => 'form-horizontal']) !!}
                    
                    <div class="form-group">
                        
                        {!! Form::label('descrizione', 'Descrizione', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::text('descrizione', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        
                        {!! Form::label('categoria', 'Categoria', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::select('categoria', \App\Documento::$enumCategoria, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class=form-group>
                        {!! Form::label('documento', "Seleziona documento" , ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" readonly>
                                <label class="input-group-btn">
                                    <span class="btn btn-primary">
                                        Sfoglia&hellip; <input type="file" style="display: none;" name="documento" multiple> 
                                    </span>
                                </label>
                            </div>
                        </div>
                            
                    </div>
                
                    <div class="form-group">
                        <button class="btn btn-success center-block" type="submit">
                            <i class="fa fa-send fa-btn"></i> Invia documento
                        </button>
                    </div>
                
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
