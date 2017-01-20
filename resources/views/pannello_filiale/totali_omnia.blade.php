@extends('pannello_filiale._dashboard', ['active' => 'totali_omnia'])
@section('inner-content')

<!--<div class="container">-->
    <div class="row">
        <div class="well col-md-4 col-md-offset-1">
            <h4>Somma liquidato omnia:</h4>
            <h3>{{ format_money($somma_liquidato) }}</h3>
        </div>
        <div class="well col-md-4 col-md-offset-1">
            <h4>Somma onorari omnia:</h4>
            <h3>{{ format_money($somma_onorari) }}</h3>
        </div>
    </div>
<!--</div>-->

@endsection