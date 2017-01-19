@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Pannello Filiale
            </h1>
            <div>
                <div class="pull-left">
                </div>
                <div class="pull-right">
                    @include ('common._dropdown_selezione_filiale')
                </div>
            </div>
        </div>



        <div class="col-md-2 sidebar bg-faded">
            <ul class="nav nav-pills nav-stacked">
                <li class="nav-item{{ (isset($active) && $active === 'compagnie_assicurative') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ action('PannelloFilialeController@compagnieAssicurative', ['filiale' => $filiale]) }}">
                        Compagnie assicurative
                    </a>
                </li>
                <li class="nav-item{{ (isset($active) && $active === 'totali_omnia') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ action('PannelloFilialeController@totaliOmnia', ['filiale' => $filiale]) }}">
                        Totali omnia
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        Medici
                    </a>
                </li>
            </ul>
        </div>

        <main class="col-md-9">
            @include('common._barra_filiale')
            
            @yield('inner-content')
        </main>
    </div>
@endsection
