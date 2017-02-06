<!-- Elenco prestazioni mediche relativi alla pratica -->
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-stethoscope"></i>
        &nbsp;
        Prestazioni mediche
    </div>

    <div class="panel-body">
        <p class="lead">Prestazioni in convenzione</p>
        
        @if (count($prestazioni_mediche_c) > 0)
            <table class="table table-hover table-striped">
                <thead>
                    <th>Nome medico</th>
                    <th>Data</th>
                    <th>Giorni</th>
                    <th>Costo</th>
                    <th>%</th>
                    <th>Percentuale</th>
                    <th>A pagare</th>
                    <th>Pagato</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($prestazioni_mediche_c as $nome_medico => $prestazioni_medico)
                        @foreach ($prestazioni_medico as $p)
                            <tr>
                                <td class="table-text"><div>{{ $p->nome_medico }}</div></td>
                                <td class="table-text"><div>{{ format_date($p->data) }}</div></td>
                                <td class="table-text"><div>{{ $p->giorni }}</div></td>
                                <td class="table-text"><div>{{ format_money($p->costo) }}</div></td>
                                <td class="table-text"><div>{{ "$p->percentuale%" }}</div></td>
                                <td class="table-text"><div>{{ format_money($p->quantitaPercentuale) }}</div></td>
                                <td class="table-text"><div>{{ format_money($p->aPagare) }}</div></td>
                                <td class="table-text"><div>{{ $p->pagato ? 'Si' : 'No' }}</div></td>
    
                                <td class="table-text">
                                    <!-- Form eliminazione prestazione -->
                                    {{ Form::open(['action' => ['PrestazioniMedicheController@destroy',
                                        'cliente' => $p->pratica->cliente, 'pratica' => $p->pratica, 'prestazione_medica' => $p],
                                        'id' => "prestazioneMedica{$p->id}DestroyForm", 'method' => 'delete']) }}
                                    {{ Form::close() }}
                                    <!-- Fine form eliminazione prestazione -->
                                    
                                    <a class="btn btn-primary" href="{{ action('PrestazioniMedicheController@edit',
                                        ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'prestazione_medica' => $p ]) }}">
                                        <i class="fa fa-fw fa-pencil"></i>
                                    </a>
                                    
                                    <a href="#" class="btn btn-danger showPrestazioneMedicaDestroyModal"
                                        data-toggle="modal" data-target="#prestazioneMedicaDestroyModal" data-prestazioneMedica="{{$p->id}}">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="info row-subtotal">
                            <td>{{ $nome_medico }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ format_money($prestazioni_medico->sum('costo')) }}</td>
                            <td></td>
                            <td>{{ format_money($prestazioni_medico->sum('quantitaPercentuale')) }}</td>
                            <td>{{ format_money($prestazioni_medico->sum('aPagare')) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    
                    <tr class="orange row-subtotal">
                        <td>Totale</td>
                        <td></td>
                        <td></td>
                        <td>{{ format_money($prestazioni_mediche_c->sum(function($p) { return $p->sum('costo'); })) }}</td>
                        <td></td>
                        <td>{{ format_money($prestazioni_mediche_c->sum(function($p) { return $p->sum('quantitaPercentuale'); })) }}</td>
                        <td>{{ format_money($prestazioni_mediche_c->sum(function($p) { return $p->sum('aPagare'); })) }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        @else
            <p>Non sono presenti prestazioni mediche in convenzione relative alla pratica.</p>
        @endif
        
        <br>
        <p class="lead">Prestazioni non in convenzione</p>        
        
        @if (count($prestazioni_mediche_nc) > 0)
            <table class="table table-hover table-striped">
                <thead>
                    <th>Nome medico</th>
                    <th>Data</th>
                    <th>Giorni</th>
                    <th>Costo</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($prestazioni_mediche_nc as $p)
                        <tr>
                            <td class="table-text"><div>{{ $p->nome_medico }}</div></td>
                            <td class="table-text"><div>{{ format_date($p->data) }}</div></td>
                            <td class="table-text"><div>{{ $p->giorni }}</div></td>
                            <td class="table-text"><div>{{ format_money($p->costo) }}</div></td>

                            <td class="table-text">
                                <!-- Form eliminazione pratica -->
                                {{ Form::open(['action' => ['PrestazioniMedicheController@destroy',
                                    'cliente' => $p->pratica->cliente, 'pratica' => $p->pratica, 'prestazione_medica' => $p],
                                    'id' => "prestazioneMedica{$p->id}DestroyForm", 'method' => 'delete']) }}
                                {{ Form::close() }}
                                <!-- Fine form eliminazione pratica -->
                                
                                <a class="btn btn-primary" href="{{ action('PrestazioniMedicheController@edit',
                                    ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'prestazione_medica' => $p ]) }}">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </a>
                                
                                <a href="#" class="btn btn-danger showPrestazioneMedicaDestroyModal"
                                    data-toggle="modal" data-target="#prestazioneMedicaDestroyModal" data-prestazioneMedica="{{$p->id}}">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    
                    <tr class="orange row-subtotal">
                        <td>Totale</td>
                        <td></td>
                        <td></td>
                        <td>{{ format_money($prestazioni_mediche_nc->sum('costo')) }}</td>
                        <td></td>
                    </tr>
                    
                </tbody>
            </table>
        @else
            <p>Non sono presenti prestazioni mediche non in convenzione relative alla pratica.</p>
        @endif
                
        
        <div class="text-center">
            <a class="btn btn-success" href="{{ action('PrestazioniMedicheController@create',
                    ['cliente' => $pratica->cliente, 'pratica' => $pratica]) }}">
                <i class="fa fa-fw fa-plus"></i>
                Aggiungi prestazione medica
            </a>
        </div>
    </div>
</div>