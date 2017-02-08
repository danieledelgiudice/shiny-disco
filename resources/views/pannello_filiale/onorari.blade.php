@extends('pannello_filiale._dashboard', ['active' => 'onorari'])
@section('inner-content')

@include('pannello_filiale._resoconto_pratiche', ['nome_campo' => 'onorari', 'nome_campo_h' => 'Onorari'])

@endsection