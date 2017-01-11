@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Dettagli Pratica
            </h1>
            <div>
                <div class="pull-left">
                    <a href="{{ action('ClientiController@show', ['cliente' => $pratica->cliente] ) }}"
                        class="btn btn-default"><i class="fa fa-fw fa-user"></i></a>
                </div>
                <div class="pull-right">
                    <a href="{{ action('PraticheController@edit', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                        class="btn btn-success"><i class="fa fa-fw fa-pencil"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Mostra errori di validazione -->
        @include('common.errors')

        <!-- Solo se admin -->
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-id-card"></i>
                &nbsp;
                Filiale: {{ $pratica->cliente->filiale->nome }}
            </div>
        </div>
        
        <!-- Riepilogo utente -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-user"></i>
                &nbsp;
                Dati Utente
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    
                    <!-- Cognome cliente -->
                    <strong class="col-md-2 form-control-static">Cognome</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->cliente->nome }}</p>
                    </div>
                    
                    <!-- Nome cliente -->
                    <strong class="col-md-2 form-control-static">Nome</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->cliente->nome }}</p>
                    </div>
                </div>
                
                
                <div class="row">
                    <!-- Codice fiscale -->
                    <strong class="col-md-2 form-control-static">Codice fiscale</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->cliente->codice_fiscale }}</p>
                    </div>
                    
                    <!-- Professione -->
                    <strong class="col-md-2 form-control-static">Professione</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">Professione1</p>
                    </div>
                </div>
                
                
                <div class="row">
                    <!-- Reddito -->    
                    <strong class="col-md-2 form-control-static">Reddito</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->cliente->reddito) ? $pratica->cliente->reddito . " €" : '' }}</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Dettagli pratica -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text"></i>
                &nbsp;
                Dati Pratica
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    
                    <!-- Numero pratica -->
                    <strong class="col-md-2 form-control-static">Numero pratica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_pratica }}</p>
                    </div>
                    
                    <!-- Numero registrazione -->
                    <strong class="col-md-2 form-control-static">Numero registrazione</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_registrazione }}</p>
                    </div>
                </div>
                
                
                <div class="row">
                    <!-- Data apertura -->
                    <strong class="col-md-2 form-control-static">Data apertura</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ format_date($pratica->data_apertura) }}</p>
                    </div>
                    
                    <!-- Stato pratica -->
                    <strong class="col-md-2 form-control-static">Stato pratica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ \App\Pratica::$enumStatoPratica[$pratica->stato_pratica] }}</p>
                    </div>
                </div>
                
                
                <div class="row">
                    <!-- Tipo pratica -->    
                    <strong class="col-md-2 form-control-static">Tipo pratica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ \App\Pratica::$enumTipoPratica[$pratica->tipo_pratica] }}</p>
                    </div>
                </div>
            </div>
        </div>
                    
        <div class="panel panel-success">
            <div class="panel-heading">
                <i class="fa fa-user"></i>
                &nbsp;
                Dettagli parte
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    <!-- Veicolo di parte -->
                    <strong class="col-md-2 form-control-static">Veicolo di parte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->veicolo_parte }}</p>
                    </div>
                
                    <!-- Targa di parte -->
                    <strong class="col-md-2 form-control-static">Targa di parte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->targa_parte }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Numero polizza di parte -->
                    <strong class="col-md-2 form-control-static">Numero polizza di parte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_polizza_parte }}</p>
                    </div>
                    
                    <!-- Assicurazione di parte -->
                    <strong class="col-md-2 form-control-static">Assicurazione di parte</strong>
                    <div class="col-md-4">
                       <p class="form-control-static">{{ $pratica->assicurazione_parte }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-danger">
            <div class="panel-heading">
                <i class="fa fa-user-secret"></i>
                &nbsp;
                Dettagli controparte
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    <!-- Conducente controparte -->
                    <strong class="col-md-2 form-control-static">Conducente controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->conducente_controparte }}</p>
                    </div>
                
                    <!-- Via controparte -->
                    <strong class="col-md-2 form-control-static">Via controparte</strong>
                    <div class="col-md-4">
                       <p class="form-control-static">{{ $pratica->via_controparte }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Città controparte -->
                    <strong class="col-md-2 form-control-static">Città controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->citta_controparte }}</p>
                    </div>
                    
                    <!-- Telefono controparte -->
                    <strong class="col-md-2 form-control-static">Telefono controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->telefono_controparte }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Veicolo controparte -->
                    <strong class="col-md-2 form-control-static">Veicolo controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->veicolo_controparte }}</p>
                    </div>
                
                    <!-- Targa controparte -->
                    <strong class="col-md-2 form-control-static">Targa controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->targa_controparte }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Numero polizza controparte -->
                    <strong class="col-md-2 form-control-static">Numero polizza controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_polizza_controparte }}</p>
                    </div>
                
                    <!-- Proprietario mezzo responsabile -->
                    <strong class="col-md-2 form-control-static">Proprietario mezzo reponsabile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->proprietario_mezzo_responsabile }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Assicurazione controparte -->
                    <strong class="col-md-2 form-control-static">Assicurazione controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->assicurazione_controparte }}</p>
                    </div>
                
                    <!-- Medico controparte -->
                    <strong class="col-md-2 form-control-static">Medico controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->medico_controparte }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-folder-open"></i>
                &nbsp;
                Dettagli pratica
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    <!-- Legale -->
                    <strong class="col-md-2 form-control-static">Legale</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->legale }}</p>
                    </div>
                
                    <!-- In data -->
                    <strong class="col-md-2 form-control-static">In data</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ format_date($pratica->in_data) }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Controllato -->
                    <strong class="col-md-2 form-control-static">Controllato</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ \App\Pratica::$enumControllato[$pratica->controllato] }}</p>
                    </div>
                    
                    <!-- Data ultima lettera -->
                    <strong class="col-md-2 form-control-static">Data ultima lettera</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ format_date($pratica->data_ultima_lettera) }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Mezzo Liquidabile -->
                    <strong class="col-md-2 form-control-static">Mezzo liquidabile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ \App\Pratica::$enumMezzoLiquidabile[$pratica->mezzo_liquidabile] }}</p>
                    </div>
                
                    <!-- Valore mezzo liquidabile -->
                    <strong class="col-md-2 form-control-static">Valore mezzo liquidabile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->valore_mezzo_liquidabile) ? "$pratica->valore_mezzo_liquidabile €" : '' }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Rilievi -->
                    <strong class="col-md-2 form-control-static">Rilievi</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ \App\Pratica::$enumRilievi[$pratica->rilievi] }}</p>
                    </div>
                
                    <!-- Data chiusura -->
                    <strong class="col-md-2 form-control-static">Data chiusura</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ format_date($pratica->data_chiusura) }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Importo sospeso -->
                    <strong class="col-md-2 form-control-static">Importo sospeso</strong>
                    <div class="col-md-4">
                       <p class="form-control-static">{{ ($pratica->importo_sospeso) ? "$pratica->importo_sospeso €" : '' }}</p>
                    </div>
                
                    <!-- Data sospeso -->
                    <strong class="col-md-2 form-control-static">Data sospeso</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ format_date($pratica->data_sospeso) }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Stato avanzamento pratica -->
                    <strong class="col-md-2 form-control-static">Stato avanzamento pratica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ \App\Pratica::$enumStatoAvanzamento[$pratica->stato_avanzamento] }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-handshake-o"></i>
                &nbsp;
                Informazioni sinistro
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    <!-- Data sinistro -->
                    <strong class="col-md-2 form-control-static">Data sinistro</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ format_date($pratica->data_sinistro) }}</p>
                    </div>
                
                    <!-- Orario sinistro -->
                    <strong class="col-md-2 form-control-static">Orario sinistro</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->ora_sinistro }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Luogo sinistro -->
                    <strong class="col-md-2 form-control-static">Luogo sinistro</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->luogo_sinistro }}</p>
                    </div>
                    
                    <!-- Testimoni -->
                    <strong class="col-md-2 form-control-static">Testimoni</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->testimoni }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Autorità -->
                    <strong class="col-md-2 form-control-static">Autorità</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ \App\Pratica::$enumAutorita[$pratica->autorita] }}</p>
                    </div>
                
                    <!-- Comando di -->
                    <strong class="col-md-2 form-control-static">Comando di</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->comando_autorita }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Rivalsa -->
                    <strong class="col-md-2 form-control-static">Rivalsa</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ \App\Pratica::$enumRivalsa[$pratica->rivalsa] }}</p>
                    </div>
                
                    <!-- Soccorso -->
                    <strong class="col-md-2 form-control-static">Soccorso</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ \App\Pratica::$enumSoccorso[$pratica->soccorso] }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Tipologia intervento -->
                    <strong class="col-md-2 form-control-static">Tipologia intervento</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->tipologia_intervento }}</p>
                    </div>
                
                    <!-- Danno presunto -->
                    <strong class="col-md-2 form-control-static">Danno presunto</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->danno_presunto) ? "$pratica->danno_presunto €" : '' }}</p>

                    </div>
                </div>
                
                <div class="row">
                    <!-- Assicurazione responsabile -->
                    <strong class="col-md-2 form-control-static">Assicurazione responsabile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->assicurazione_responsabile }}</p>
                    </div>
                
                    <!-- Assicurazione risarcente -->
                    <strong class="col-md-2 form-control-static">Assicurazione risarcente</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->assicurazione_risarcente }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Numero sinistro -->
                    <strong class="col-md-2 form-control-static">Numero sinistro</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_sinistro }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Mezzo visibile -->
                    <strong class="col-md-2 form-control-static">Mezzo visibile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->mezzo_visibile }}</p>
                    </div>
                    
                    <!-- Dinamica -->
                    <strong class="col-md-2 form-control-static">Dinamica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->dinamica }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Note -->
                    <strong class="col-md-2 form-control-static">Note</strong>
                    <div class="col-md-10">
                       <p class="form-control-static">{{ $pratica->note }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sticky-note"></i>
                &nbsp;
                Documenti pratica
            </div>

            <div class="panel-body">
                @if (count($documenti) > 0)
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Nome documento</th>
                            <th>Tipo documento</th>
                            <th>Data inserimento</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($documenti as $documento)
                                <tr class="">
                                    <td class="table-text"><div>{{ $documento->descrizione }}</div></td>
                                    <td class="table-text"><div>{{ $documento->mime }}</div></td>
                                    <td class="table-text"><div>{{ format_date($documento->created_at) }}</div></td>
                                    
                                    <td class="table-text">
                                        <a class="btn btn-default" href="{{ action('DocumentiController@show',
                                            ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'documento' => $documento ]) }}">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Non sono presenti documenti relativi alla pratica.</p>
                @endif
            </div>
        </div>
        
        <!-- Elenco assegni relativi alla pratica -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-sticky-note"></i>
                &nbsp;
                Assegni pratica
            </div>

            <div class="panel-body">
                @if (count($assegni) > 0)
                    <table class="table table-hover table-striped">
                        <thead>
                            <th class="text-center">#</th>
                            <th>Data</th>
                            <th>Importo</th>
                            <th>Banca</th>
                            <th>Consegnato il</th>
                            <th>Restituito il</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($assegni as $index => $assegno)
                                <tr class="">
                                    <td class="table-text"><div class="text-center">{{ $index+1 }}</div></td>
                                    <td class="table-text"><div>{{ format_date($assegno->data) }}</div></td>
                                    <td class="table-text"><div>{{ $assegno->importo }} €</div></td>
                                    <td class="table-text"><div>{{ $assegno->banca }}</div></td>
                                    <td class="table-text"><div>{{ $assegno->tipologia ? '' : format_date($assegno->data_azione) }}</div></td>
                                    <td class="table-text"><div>{{ $assegno->tipologia ? format_date($assegno->data_azione) : '' }}</div></td>
                                    
                                    <td class="table-text">
                                        <a class="btn btn-success" href="{{ action('AssegniController@edit',
                                            ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'assegno' => $assegno ]) }}">
                                            <i class="fa fa-fw fa-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Non sono presenti assegni relativi alla pratica.</p>
                @endif
                <div class="text-center">
                    <a class="btn btn-success" href="{{ action('AssegniController@create',
                            ['cliente' => $pratica->cliente, 'pratica' => $pratica]) }}">
                        <i class="fa fa-fw fa-plus"></i>
                        Aggiungi assegno
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
