<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Elys Management</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <link href="{{ URL::asset('css/lib/selectize.bootstrap3.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">


    <style>
        body {
            font-family: 'Lato';
            @if (isset($background_color))
                background: linear-gradient(to bottom, #ffffff 1%,{{ $background_color }} 100%);
            @endif
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Elys Management
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::user())
                        <li><a href="{{ action('PromemoriaController@indexToday', ['filiale' => Auth::user()->filiale]) }}">Agenda</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clienti <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ action('ClientiController@index') }}"><i class="fa fa-fw fa-users"></i>&nbsp;&nbsp;Lista clienti</a></li>
                                <li><a href="{{ action('ClientiController@create') }}"><i class="fa fa-fw fa-plus"></i>&nbsp;&nbsp;Aggiungi cliente</a></li>
                            </ul>
                        </li>


                        <li><a href="{{ action('PraticheController@index') }}">Pratiche</a></li>
                        <li><a href="{{ action('DocumentiController@create', ['filiale' => Auth::user()->filiale->id]) }}">Carica documenti</a></li>
                    @endif
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                @if (Auth::user()->isAdmin())
                                    <i class="fa fa-fw fa-gear"></i>
                                @endif
                                {{ Auth::user()->filiale->nome }}
                                &nbsp;
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ action('PannelloFilialeController@home', ['filiale' => Auth::user()->filiale]) }}"><i class="fa fa-btn fa-window-maximize"></i>Pannello filiale</a></li>
                                @if (Auth::user()->isAdmin())
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ action('FilialiController@index') }}"><i class="fa fa-btn fa-gear"></i>Gestione filiali</a></li>
                                    <li><a href="{{ action('PromemoriaController@indexAll', ['filiale' => Auth::user()->filiale]) }}"><i class="fa fa-btn fa-gear"></i>Elenco promemoria</a></li>
                                    <li><a href="{{ action('StrumentiController@index') }}"><i class="fa fa-btn fa-gear"></i>Strumenti</a></li>
                                @endif
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @include('common._flash_message')

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.it-CH.min.js"></script>

    <script type="text/javascript" src="{{ URL::asset('js/lib/selectize.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}?ver={{ filemtime(public_path('js/app.js')) }}"></script>
</body>
</html>
