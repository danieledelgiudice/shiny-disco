@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-header text-center">Gestione filiali</h1>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Id</th>
                        <th>Nome filiale</th>
                        <th>Indirizzo</th>
                        <th>Telefono</th>
                        <th>Abilitata</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($filiali as $filiale)
                        <tr>
                            <td class="table-text">
                                <div>{{ $filiale->id }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $filiale->nome }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $filiale->indirizzo }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $filiale->telefono }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $filiale->utente->enabled ? '✅' : '❌' }}</div>
                            </td>

                            <td class="col-md-1">
                                <a class="btn btn-primary" href="{{ action('FilialiController@edit', ['filiale' => $filiale]) }}">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center">
                    <a class="btn btn-success" href="{{ action('FilialiController@create') }}">
                        <i class="fa fa-fw fa-plus"></i>Aggiungi filiale
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
