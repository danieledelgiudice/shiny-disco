@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-header text-center">Elenco Clienti</h1>
        <div>
            <div class="panel panel-default">
                <!-- Lista clienti -->
                @if (count($clienti) > 0)
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-filterable">
                            <thead>
                                {{ Form::open(['action' => ['ClientiController@filter'], 'class' => 'form-horizontal']) }}
                                    <th>
                                        Cognome
                                        <br>
                                        {{ Form::text('cognome', null, [ 'class' => 'form-control']) }}
                                    </th>
                                    
                                    <th>
                                        Nome
                                        <br>
                                        {{ Form::text('nome', null, [ 'class' => 'form-control']) }}
                                    </th>
                                    
                                    <th>
                                        Codice Fiscale
                                        <br>
                                        {{ Form::text('codice_fiscale', null, [ 'class' => 'form-control']) }}
                                    </th>
                                    
                                    <th>Professione</th>
                                    
                                    <th>Filiale</th>
                                    
                                    <th>
                                        <a href="{{ action('ClientiController@index') }}" class="btn btn-default">
                                               <i class="fa fa-times"></i> 
                                        </a>
                                        <button class="btn btn-primary">
                                               <i class="fa fa-search"></i> 
                                        </button>
                                    </th>
                                {{ Form::close() }}
                            </thead>
                            <tbody>
                                @foreach ($clienti as $cliente)
                                    <tr>
                                        <td class="table-text" data-field="cognome"><div>{{ $cliente->cognome }}</div></td>
                                        <td class="table-text" data-field="nome"><div>{{ $cliente->nome }}</div></td>
                                        <td class="table-text" data-field="codice_fiscale"><div>{{ $cliente->codice_fiscale }}</div></td>
                                        <td class="table-text"><div>Filiale1</div></td>
                                        <td class="table-text"><div>Professione1</div></td>

                                        <!-- Dettagli/Modifica cliente -->
                                        <td>
                                            <a href="{{ action('ClientiController@show', $cliente)}}" class="btn btn-default">
                                               <i class="fa fa-eye"></i> 
                                            </a>
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