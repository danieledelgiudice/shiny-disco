@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header text-center">
            <h1>Elenco completo promemoria</h1>
            <div>
                <div class="pull-left">
                </div>
                <div class="pull-right">
                    @include ('common._dropdown_selezione_filiale')
                </div>
            </div>
        </div>
        <div>
            @include('common._barra_filiale')
            <div class="panel panel-default">
               <div class="panel-body">
                    {{ Form::open(['action' => ['PromemoriaController@indexAll', 'filiale' => $filiale], 'class' => 'form-horizontal', 'method' => 'GET' ]) }}
    
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-1">
                                <strong>Numero pratica</strong>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-chevron-right"></i></span>
                                            <input type="number" min="0" name="numero_pratica[]" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-chevron-left"></i></span>
                                            <input type="number" min="0" name="numero_pratica[]" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 text-center">
                                <button type="submit" class="btn btn-primary">
                                       <i class="fa fa-fw fa-search"></i>
                                       Cerca
                                </button>
                                <a href="{{ action('PromemoriaController@indexAll', ['filiale' => $filiale]) }}" class="btn btn-default">
                                       <i class="fa fa-times"></i> 
                                </a>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="panel panel-default">
                <!-- Lista promemoria da completare -->
                <div class="panel-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Numero pratica</th>
                            <th>Chi</th>
                            <th>Quando</th>
                            <th>Cosa</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
                        @if (count($promemoria) > 0)
                            <tbody>
                                @foreach ($promemoria as $p)
                                    <tr class="{{ $p->trashed() ? 'trashed' : '' }}">
                                        <td class="table-text col-md-2"><div>{{ $p->pratica->numero_pratica }}</div></td>
                                        <td class="table-text col-md-2"><div>{{ $p->chi }}</div></td>
                                        <td class="table-text col-md-2"><div>{{ date_diff_days($p->quando) }}</div></td>
                                        <td class="table-text col-md-6"><div>{{ $p->cosa }}</div></td>
                                        <td class="col-md-1">
                                            <a class="btn btn-default" href="{{ action('PraticheController@show', 
                                                ['cliente' => $p->pratica->cliente, 'pratica' => $p->pratica])}}">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>
                                        </td>
                                        <td class="col-md-1">
                                            @if (!$p->trashed())
                                                {!! Form::open(['action' => ['PromemoriaController@destroy', 'cliente' => $p->pratica->cliente,
                                                    'pratica' => $p->pratica, 'promemoria' => $p], 'method' => 'delete']) !!}
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-fw fa-check"></i>
                                                    </button>
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                    @if (count($promemoria) == 0)
                        <p class="text-center">Non sono presenti promemoria nel database</p>
                    @else
                        <div class="text-center">
                            {{ $promemoria->appends(Request::except('page'))->links() }}    
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection