@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Modifica Pratica
            </h1>
            <div>
                <div class="pull-left">
                    <a id="backButton" href="#" class="btn btn-default"><i class="fa fa-arrow-left"></i></a>
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>
        
        <!-- Mostra errori di validazione -->
        @include('common.errors')

        <!-- Form Modifica Cliente -->
        {!! Form::model($pratica, ['method' => 'put', 'class' => 'form-horizontal']) !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text"></i>
                    &nbsp;
                    Dati Pratica
                </div>

                <div class="panel-body">
                        
                    <div class="form-group">
                        
                        <!-- Numero pratica -->
                        {!! Form::label('numero_pratica', 'Numero pratica' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('numero_pratica', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <!-- Numero registrazione -->
                        {!! Form::label('numero_registrazione', 'Numero registrazione' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('numero_registrazione', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <!-- Data apertura -->
                        {!! Form::label('data_apertura', 'Data apertura' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            <div class="input-group date">
                                {!! Form::text('data_apertura', $pratica->data_apertura->format('d/m/Y'), ['class' => 'form-control date-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                        
                        <!-- Stato pratica -->
                        {!! Form::label('stato_pratica', 'Stato pratica' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::select('stato_pratica', $pratica->enumStatoPratica, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <!-- Tipo pratica -->    
                        {!! Form::label('tipo_pratica', 'Tipo pratica' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {{ Form::select('tipo_pratica', $pratica->enumTipoPratica, null, ['class' => 'form-control']) }}
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
                        
                    <div class="form-group">
                        <!-- Veicolo di parte -->
                        {!! Form::label('veicolo_parte', 'Veicolo di parte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('veicolo_parte', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Targa di parte -->
                        {!! Form::label('targa_parte', 'Targa di parte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('targa_parte', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Numero polizza di parte -->
                        {!! Form::label('numero_polizza_parte', 'Numero polizza di parte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('numero_polizza_parte', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <!-- Assicurazione di parte -->
                        {!! Form::label('assicurazione_parte', 'Assicurazione di parte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('assicurazione_parte', null, ['class' => 'form-control']) !!}
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
                        
                    <div class="form-group">
                        <!-- Nominativo controparte -->
                        {!! Form::label('nominativo_controparte', 'Nominativo controparte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('nominativo_controparte', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Via controparte -->
                        {!! Form::label('via_controparte', 'Via controparte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('via_controparte', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Città controparte -->
                        {!! Form::label('citta_controparte', 'Città controparte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('citta_controparte', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <!-- Telefono controparte -->
                        {!! Form::label('telefono_controparte', 'Telefono controparte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('telefono_controparte', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Veicolo controparte -->
                        {!! Form::label('veicolo_controparte', 'Veicolo controparte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('veicolo_controparte', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Targa controparte -->
                        {!! Form::label('targa_controparte', 'Targa controparte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('targa_controparte', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Numero polizza controparte -->
                        {!! Form::label('numero_polizza_controparte', 'Numero polizza controparte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('numero_polizza_controparte', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Proprietario mezzo responsabile -->
                        {!! Form::label('proprietario_mezzo_responsabile', 'Proprietario mezzo responsabile' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('proprietario_mezzo_responsabile', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Assicurazione controparte -->
                        {!! Form::label('assicurazione_controparte', 'Assicurazione controparte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('assicurazione_controparte', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Medico controparte -->
                        {!! Form::label('medico_controparte', 'Medico controparte' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('medico_controparte', null, ['class' => 'form-control']) !!}
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
                        
                    <div class="form-group">
                        <!-- Legale -->
                        {!! Form::label('legale', 'Legale' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('legale', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- In data -->
                        {!! Form::label('in_data', 'In data' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            <div class="input-group date">
                                {!! Form::text('in_data', $pratica->in_data->format('d/m/Y'), ['class' => 'form-control date-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Controllato -->
                        {!! Form::label('controllato', 'Controllato' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::select('controllato', $pratica->enumControllato, null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <!-- Data ultima lettera -->
                        {!! Form::label('data_ultima_lettera', 'Data ultima lettera' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            <div class="input-group date">
                                {!! Form::text('data_ultima_lettera', $pratica->data_ultima_lettera->format('d/m/Y'), ['class' => 'form-control date-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Mezzo Liquidabile -->
                        {!! Form::label('mezzo_liquidabile', 'Mezzo Liquidabile' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::select('mezzo_liquidabile', $pratica->enumMezzoLiquidabile, null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Valore mezzo liquidabile -->
                        {!! Form::label('valore_mezzo_liquidabile', 'Valore mezzo liquidabile' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            <div class="input-group">
                                {!! Form::number('valore_mezzo_liquidabile', null, ['class' => 'form-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Rilievi -->
                        {!! Form::label('rilievi', 'Rilievi' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::select('rilievi', $pratica->enumRilievi, null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Data chiusura -->
                        {!! Form::label('data_chiusura', 'Data chiusura' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            <div class="input-group date">
                                {!! Form::text('data_chiusura', $pratica->data_chiusura->format('d/m/Y'), ['class' => 'form-control date-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Importo sospeso -->
                        {!! Form::label('importo_sospeso', 'Importo sospeso' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            <div class="input-group">
                                {!! Form::number('valore_mezzo_liquidabile', null, ['class' => 'form-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                            </div>
                        </div>
                    
                        <!-- Data sospeso -->
                        {!! Form::label('data_sospeso', 'Data sospeso' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            <div class="input-group date">
                                {!! Form::text('data_sospeso', $pratica->data_sospeso->format('d/m/Y'), ['class' => 'form-control date-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Stato avanzamento pratica -->
                        {!! Form::label('stato_avanzamento', 'Stato avanzamento pratica' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::select('stato_avanzamento', $pratica->enumStatoAvanzamento, null, ['class' => 'form-control']) !!}
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
                        
                    <div class="form-group">
                        <!-- Dato sinistro -->
                        {!! Form::label('data_sinistro', 'Data sinistro' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            <div class="input-group date">
                                {!! Form::text('data_sinistro', $pratica->data_sinistro->format('d/m/Y') , ['class' => 'form-control date-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                    
                        <!-- Orario sinistro -->
                        {!! Form::label('ora_sinistro', 'Orario sinistro' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('ora_sinistro', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Luogo sinistro -->
                        {!! Form::label('luogo_sinistro', 'Luogo sinistro' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('luogo_sinistro', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <!-- Testimoni -->
                        {!! Form::label('testimoni', 'Testimoni' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('testimoni', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Autorità -->
                        {!! Form::label('autorita', 'Autorità' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::select('autorita', $pratica->enumAutorita, null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Comando di -->
                        {!! Form::label('comando_autorita', 'Comando di' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('comando_autorita', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Rivalsa -->
                        {!! Form::label('rivalsa', 'Rivalsa' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::select('rivalsa', $pratica->enumRivalsa, null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Soccorso -->
                        {!! Form::label('soccorso', 'Soccorso' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::select('soccorso', $pratica->enumSoccorso, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Tipologia intervento -->
                        {!! Form::label('tipologia_intervento', 'Tipologia intervento' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('tipologia_intervento', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Danno presunto -->
                        {!! Form::label('danno_presunto', 'Danno presunto' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            <div class="input-group">
                                {!! Form::number('danno_presunto', null, ['class' => 'form-control']) !!}
                                <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Assicurazione responsabile -->
                        {!! Form::label('assicurazione_responsabile', 'Assicurazione responsabile' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('assicurazione_responsabile', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        <!-- Assicurazione risarcente -->
                        {!! Form::label('assicurazione_risarcente', 'Assicurazione risarcente' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('assicurazione_risarcente', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Numero sinistro -->
                        {!! Form::label('numero_sinistro', 'Numero sinistro' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('numero_sinistro', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Mezzo visibile -->
                        {!! Form::label('mezzo_visibile', 'Mezzo visibile' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('mezzo_visibile', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <!-- Dinamica -->
                        {!! Form::label('dinamica', 'Dinamica' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('dinamica', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- Note -->
                        {!! Form::label('note', 'Note' , ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-10">
                            {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- Conferma/Annulla cambiamenti -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary center-block">
                    <i class="fa fa-btn fa-pencil"></i>Modifica pratica
                </button>
            </div>
        {!! Form::close() !!}
        <!--</form>-->
    </div>
@endsection
