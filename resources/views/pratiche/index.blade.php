@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-header text-center">Elenco Pratiche</h1>
        <div>
            <div class="panel panel-default">
                <!-- Lista pratiche -->
                @if (count($pratiche) > 0)
                    <div class="panel-body">
                        <table class="table table-striped city-table">
                            <thead>
                                <th>Numero pratica</th>
                                <th>Stato pratica</th>
                                <th>Tipo pratica</th>
                                <th>Data apertura</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($pratiche as $pratica)
                                    <tr class="">
                                        <td class="table-text"><div>{{ $pratica->numero_pratica }}</div></td>
                                        <td class="table-text"><div>{{ $pratica->enumStatoPratica[$pratica->stato_pratica] }}</div></td>
                                        <td class="table-text"><div>{{ $pratica->enumTipoPratica[$pratica->tipo_pratica] }}</div></td>
                                        <td class="table-text"><div>{{ $pratica->data_apertura->format('d/m/Y') }}</div></td>

                                        <!-- Modifica pratica -->
                                        <td>
                                            <a href="{{ action('PraticheController@edit', $pratica)}}" class="btn btn-success">
                                               <i class="fa fa-pencil"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Non sono presenti pratiche</p>
                @endif
            </div>
        </div>
    </div>
@endsection