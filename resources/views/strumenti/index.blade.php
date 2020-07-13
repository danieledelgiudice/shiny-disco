@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-header text-center">Strumenti</h1>
        <div>
            <div class="list-group">
                <a class="list-group-item" href="{{ action('StrumentiController@exportClients') }}" target="_blank">
                    <h4 class="list-group-item-heading">Export lista utenti</h4>
                    <p class="list-group-item-text">
                        Seleziona per generare un file CSV contenente i dati Nome, Cognome, Email, Cellulare, Telefono appartanenti a ciascun cliente registrato
                    </p>
                </a>
            </div>
        </div>
    </div>
@endsection