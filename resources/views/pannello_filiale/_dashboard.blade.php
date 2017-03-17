@extends('layouts.app')

@section('content')
    <div class="container">
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
    </div>
        
    <div class="container-fluid">
        <div class="col-md-2 sidebar bg-faded">
            <ul class="nav nav-pills nav-stacked">
                <li class="nav-item{{ (isset($active) && $active === 'onorari') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ action('PannelloFilialeController@onorari', ['filiale' => $filiale]) }}">
                        Onorari
                    </a>
                </li>
                <li class="nav-item{{ (isset($active) && $active === 'liquidato_omnia') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ action('PannelloFilialeController@liquidatoOmnia', ['filiale' => $filiale]) }}">
                        Liquidato omnia
                    </a>
                </li>
                <li class="nav-item{{ (isset($active) && $active === 'importo_sospeso') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ action('PannelloFilialeController@importoSospeso', ['filiale' => $filiale]) }}">
                        Importo sospeso
                    </a>
                </li>
                <li class="nav-item{{ (isset($active) && $active === 'parcella_presunta') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ action('PannelloFilialeController@parcellaPresunta', ['filiale' => $filiale]) }}">
                        Parcella presunta
                    </a>
                </li>
                <li class="nav-item{{ (isset($active) && $active === 'sospesi_medici') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ action('PannelloFilialeController@sospesiMedici', ['filiale' => $filiale]) }}">
                        Sospesi medici
                    </a>
                </li>
                @can('generare-fatture')
                    <li class="nav-item{{ (isset($active) && $active === 'fatture') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ action('PannelloFilialeController@fatture', ['filiale' => $filiale]) }}">
                            Fatture
                        </a>
                    </li>
                @endcan
            </ul>
        </div>

        <main class="col-md-8">
            @include('common._barra_filiale')
            
            @yield('inner-content')
        </main>
    </div>
@endsection
