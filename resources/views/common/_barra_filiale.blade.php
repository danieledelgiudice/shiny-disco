<!-- Solo se admin -->
@if ( Auth::user()->isAdmin() )
<div class="panel panel-warning">
    <div class="panel-heading">
        <i class="fa fa-id-card"></i>
        &nbsp;
        Filiale: 
        @if (isset($pratica) && $pratica->id)
            {{ $pratica->cliente->filiale->nome }}
        @elseif (isset($cliente) && $cliente->id)
            {{ $cliente->filiale->nome }}
        @endif
    </div>
</div>
@endif