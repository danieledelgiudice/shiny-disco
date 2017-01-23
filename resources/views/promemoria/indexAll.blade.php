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
                <!-- Lista promemoria da completare -->
                <div class="panel-body">
                    <table class="table table-hover table-striped">
                        <thead>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection