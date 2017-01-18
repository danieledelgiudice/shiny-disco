@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-header text-center">Elenco Clienti</h1>
        <div>
            <div class="panel panel-default">
                <!-- Lista clienti -->
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
                                
                                <th>
                                    Professione
                                    <br>
                                    {{ Form::select('professione', $professioni, null, [ 'placeholder' => '', 'class' => 'form-control' ]) }}
                                </th>
                                
                                <th>
                                    Filiale
                                    <br>
                                    {{ Form::select('filiale', $filiali, null, [ 'placeholder' => '', 'class' => 'form-control' ]) }}
                                </th>
                                
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
                        @if (count($clienti) > 0)
                            <tbody>
                                @foreach ($clienti as $cliente)
                                    <tr>
                                        <td class="table-text col-md-2" data-field="cognome"><div>{{ $cliente->cognome }}</div></td>
                                        <td class="table-text col-md-2" data-field="nome"><div>{{ $cliente->nome }}</div></td>
                                        <td class="table-text col-md-2" data-field="codice_fiscale"><div>{{ $cliente->codice_fiscale }}</div></td>
                                        <td class="table-text col-md-2" data-field-select="professione" data-field-id="{{ $cliente->professione_id }}">
                                            <div>{{ $cliente->professione ? $cliente->professione->nome : '' }}</div>
                                        </td>
                                        <td class="table-text col-md-2" data-field-select="filiale" data-field-id="{{ $cliente->filiale_id }}">
                                            <div>{{ $cliente->filiale ? $cliente->filiale->nome : '' }}</div>
                                        </td>

                                        <!-- Dettagli/Modifica cliente -->
                                        <td>
                                            <a href="{{ action('ClientiController@show', $cliente)}}" class="btn btn-default">
                                               <i class="fa fa-eye"></i> 
                                            </a>
                                            <a href="{{ action('ClientiController@edit', $cliente)}}" class="btn btn-primary">
                                               <i class="fa fa-pencil"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
                @if (count($clienti) == 0)
                    <p class="text-center">Non sono presenti clienti</p>
                @endif
            </div>
        </div>
    </div>
@endsection