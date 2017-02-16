<!-- Solo se admin -->
@if ( Auth::user()->isAdmin() )
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
            Mostra altra filiale
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            @if (isset($mostraOpzioneTutte))
                <li><a href="{{ url_filiale(URL::current(), $mostraOpzioneTutte) }}">Tutte le filiali</a></li>
            @endif
            @foreach ($filiali as $f)
                <li><a href="{{ url_filiale(URL::current(), $f) }}">{{ $f->nome }}</a></li>
            @endforeach
        </ul>
    </div>
@endif