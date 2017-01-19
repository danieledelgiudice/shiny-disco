@extends('layouts.app')

@section('content')
    
    <div class="container">
        <h1 class="page-header text-center">Elenco Compagnie Assicurative</h1>
        <div>
            @include('compagnie_assicurative._elenco')
        </div>
    </div>
@endsection