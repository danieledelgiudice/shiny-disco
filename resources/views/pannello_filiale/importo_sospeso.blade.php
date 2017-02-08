@extends('pannello_filiale._dashboard', ['active' => 'importo_sospeso'])
@section('inner-content')

@include('pannello_filiale._resoconto_pratiche', ['nome_campo' => 'importo_sospeso', 'nome_campo_h' => 'Importo Sospeso'])

@endsection