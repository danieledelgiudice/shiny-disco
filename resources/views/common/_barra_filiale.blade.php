<!-- Solo se admin -->
@if ( Auth::user()->isAdmin())
<div class="panel panel-warning">
    <div class="panel-heading">
        <i class="fa fa-id-card"></i>
        &nbsp;
        Filiale: 
        @if (isset($filiale) && ($filiale instanceof \App\Filiale))
            {{ $filiale->nome }}
        @elseif (isset($filiale) && ($filiale == 0))
            Tutte
        @elseif (isset($pratica) && $pratica->id)
            {{ $pratica->cliente->filiale->nome }}
        @elseif (isset($cliente) && $cliente->id)
            {{ $cliente->filiale->nome }}
        @endif
    </div>
</div>
@endif