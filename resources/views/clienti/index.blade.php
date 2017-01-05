@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-header text-center">Elenco Clienti</h1>
        <div>
            <div class="panel panel-default">
                <!-- Lista clienti -->
                @if (count($clienti) > 0)
                    <div class="panel-body">
                        <table class="table table-striped city-table">
                            <thead>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Città di residenza</th>
                                <th>Data di nascita</th>
                                <th>Codice Fiscale</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($clienti as $cliente)
                                    <tr class="link-row" data-href="{{ action('ClientiController@show', $cliente)}}">
                                        <td class="table-text"><div>{{ $cliente->nome }}</div></td>
                                        <td class="table-text"><div>{{ $cliente->cognome }}</div></td>
                                        <td class="table-text"><div>{{ $cliente->citta_residenza }}</div></td>
                                        <td class="table-text"><div>{{ $cliente->data_nascita }}</div></td>
                                        <td class="table-text"><div>{{ $cliente->codice_fiscale }}</div></td>

                                        <!-- Modifica cliente -->
                                        <td>
                                            <a href="{{ action('ClientiController@edit', $cliente)}}" class="btn btn-success">
                                               <i class="fa fa-pencil"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Non sono presenti clienti</p>
                @endif
            </div>
        </div>
    </div>
@endsection