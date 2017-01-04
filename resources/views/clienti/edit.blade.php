@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Modifica Cliente
                </div>

                <div class="panel-body">
                    <!-- Mostra errori di validazione -->
                    @include('common.errors')

                    <!-- Form Modifica Cliente -->
                    {!! Form::model($cliente, ['action' => ['ClientiController@update', $cliente], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                        
                        @foreach ($cliente->toArray() as $colonna => $valore)
                            @if (array_key_exists($colonna, $cliente->displayName)) 
                                <!-- Nome Cliente -->
                                <div class="form-group">
                                    {!! Form::label($colonna, $cliente->displayName[$colonna], ['class' => 'col-sm-3 control-label']) !!}
        
                                    <div class="col-sm-6">
                                        {!! Form::text($colonna, null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        
                        <!-- Conferma/Annulla cambiamenti -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-pencil"></i>Modifica Cliente
                                </button>
                                
                                <a href="{{ action('ClientiController@index')}}" class="btn btn-success pull-right">
                                    <i class="fa fa-btn fa-undo"></i>Annulla Cambiamenti
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>
@endsection