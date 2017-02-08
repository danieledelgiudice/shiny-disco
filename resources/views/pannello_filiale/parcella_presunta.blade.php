@extends('pannello_filiale._dashboard', ['active' => 'parcella_presunta'])
@section('inner-content')

@include('pannello_filiale._resoconto_pratiche', ['nome_campo' => 'parcella_presunta', 'nome_campo_h' => 'Parcella Presunta'])

@endsection