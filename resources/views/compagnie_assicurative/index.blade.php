@extends('layouts.app')

@section('content')
    @include('common._modal_elimina',
       ['resource' => 'compagnia',
        'message' => 'Sei sicuro di voler eliminare la compagnia? Questa operazione non potrà essere annullata.'])
    
    <div class="container">
        <h1 class="page-header text-center">Elenco Compagnie Assicurative</h1>
        <div>
            <div class="panel panel-default">
                <!-- Lista compagnie assicurative -->
                <div class="panel-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Nome</th>
                            <th>Indirizzo</th>
                            <th>Telefono</th>
                            <th>Fax</th>
                            <th>Email</th>
                            <th>Giorni</th>
                            <th>&nbsp;</th>
                        </thead>
                        @if (count($compagnie_assicurative) > 0)
                            <tbody>
                                @foreach ($compagnie_assicurative as $compagnia)
                                    <tr>
                                        <td class="table-text col-md-2"><div>{{ $compagnia->nome }}</div></td>
                                        <td class="table-text col-md-4"><div>{{ $compagnia->indirizzo }}</div></td>
                                        <td class="table-text col-md-1"><div>{{ $compagnia->telefono }}</div></td>
                                        <td class="table-text col-md-1"><div>{{ $compagnia->fax }}</div></td>
                                        <td class="table-text col-md-1"><div>{{ $compagnia->email }}</div></td>
                                        <td class="table-text col-md-1"><div>{{ $compagnia->giorni }}</div></td>
                                        <td class="table-text col-md-2">
                                            <a href="{{ action('CompagnieAssicurativeController@edit', ['filiale' => $compagnia->filiale, 'compagnia_assicurativa' => $compagnia])}}"
                                                class="btn btn-success">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                            
                                            @if (count($compagnia->parti_assicurate) + count($compagnia->controparti_assicurate) == 0)
                                                <a href="#" class="btn btn-danger showCompagniaDestroyModal"
                                                    data-toggle="modal" data-target="#compagniaDestroyModal" data-compagnia="{{$compagnia->id}}">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </a>
                                                
                                                <!-- Form eliminazione compagnia -->
                                                {{ Form::open(['action' => ['CompagnieAssicurativeController@destroy',
                                                    'filiale' => $compagnia->filiale, 'compagnia_assicurativa' => $compagnia],
                                                    'id' => "compagnia{$compagnia->id}DestroyForm", 'method' => 'delete']) }}
                                                {{ Form::close() }}
                                                <!-- Fine form eliminazione compagnia -->
                                            @else
                                                <a href="#" class="btn btn-default" disabled data-toggle="tooltip" data-placement="right"
                                                    title="Sono presenti pratiche che sfruttano ancora questa compagnia!">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                    @if (count($compagnie_assicurative) == 0)
                        <p class="text-center">Non sono presenti compagnie assicurative per questa filiale</p>
                    @endif
                    <div class="text-center">
                        <a class="btn btn-success" href="{{ action('CompagnieAssicurativeController@create',
                                ['filiale' => $filiale]) }}">
                            <i class="fa fa-fw fa-plus"></i>
                            Aggiungi compagnia assicurativa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection