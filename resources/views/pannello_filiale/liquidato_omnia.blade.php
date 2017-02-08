@extends('pannello_filiale._dashboard', ['active' => 'liquidato_omnia'])
@section('inner-content')

@include('pannello_filiale._resoconto_pratiche', ['nome_campo' => 'liquidato_omnia', 'nome_campo_h' => 'Liquidato Omnia'])

@endsection