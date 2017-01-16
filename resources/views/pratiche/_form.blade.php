@if ($pratica->id)
    {!! Form::model($pratica, ['action' => ['PraticheController@update', 'cliente' => $pratica->cliente, 'pratica' => $pratica],
        'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::model($pratica, ['action' => ['PraticheController@store', 'cliente' => $pratica->cliente],
        'class' => 'form-horizontal']) !!}
@endif
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
                        {!! Form::text('data_apertura', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
                
                <!-- Stato pratica -->
                {!! Form::label('stato_pratica', 'Stato pratica' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::select('stato_pratica', \App\Pratica::$enumStatoPratica, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            
            <div class="form-group">
                <!-- Tipo pratica -->    
                {!! Form::label('tipo_pratica', 'Tipo pratica' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {{ Form::select('tipo_pratica', \App\Pratica::$enumTipoPratica, null, ['class' => 'form-control']) }}
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
                {!! Form::label('assicurazione_parte_id', 'Assicurazione di parte' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <select class="" placeholder="" data-selecttype="assicurazioni" name="assicurazione_parte_id" id="assicurazione_parte_id">
                        <option value="" {{ (!$pratica->id || !$pratica->assicurazione_parte_id) ? 'selected' : ''}}> </option>
                        @foreach($assicurazioni as $assicurazione)
                            <option value="{{ $assicurazione->id }}" data-data="{{ json_encode(['indirizzo' => $assicurazione->indirizzo]) }}"
                                {{ ($pratica && $pratica->assicurazione_parte_id == $assicurazione->id) ? 'selected' : ''}}>
                                {{ $assicurazione->nome}}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ action('CompagnieAssicurativeController@create', ['filiale' => $filiale]) }}" class="btn btn-primary">
                        <i class="fa fa-fw fa-plus"></i>
                    </a>
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
                <!-- Conducente controparte -->
                {!! Form::label('conducente_controparte', 'Conducente controparte' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('conducente_controparte', null, ['class' => 'form-control']) !!}
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
                {!! Form::label('assicurazione_controparte_id', 'Assicurazione controparte' , ['class' => 'control-label col-md-2']) !!}
                <div class="col-md-4">
                    <select class="" placeholder="" data-selecttype="assicurazioni" name="assicurazione_controparte_id" id="assicurazione_controparte_id">
                        <option value="" {{ (!$pratica->id || !$pratica->assicurazione_parte_id) ? 'selected' : ''}}> </option>
                        @foreach($assicurazioni as $assicurazione)
                            <option value="{{ $assicurazione->id }}" data-data="{{ json_encode(['indirizzo' => $assicurazione->indirizzo]) }}"
                                {{ ($pratica && $pratica->assicurazione_controparte_id == $assicurazione->id) ? 'selected' : ''}}>
                                {{ $assicurazione->nome}}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ action('CompagnieAssicurativeController@create', ['filiale' => $filiale]) }}" class="btn btn-primary">
                        <i class="fa fa-fw fa-plus"></i>
                    </a>
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
                        {!! Form::text('in_data', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <!-- Controllato -->
                {!! Form::label('controllato', 'Controllato' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::select('controllato', \App\Pratica::$enumControllato, null, ['class' => 'form-control']) !!}
                </div>
                
                <!-- Data ultima lettera -->
                {!! Form::label('data_ultima_lettera', 'Data ultima lettera' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('data_ultima_lettera', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <!-- Mezzo Liquidato -->
                {!! Form::label('mezzo_liquidato', 'Mezzo Liquidato' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('mezzo_liquidato', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            
                <!-- Valore mezzo liquidato -->
                {!! Form::label('valore_mezzo_liquidato', 'Valore mezzo liquidato' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group">
                        {!! Form::number('valore_mezzo_liquidato', null, ['class' => 'form-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <!-- Rilievi -->
                {!! Form::label('rilievi', 'Rilievi' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::select('rilievi', \App\Pratica::$enumRilievi, null, ['class' => 'form-control']) !!}
                </div>
            
                <!-- Data chiusura -->
                {!! Form::label('data_chiusura', 'Data chiusura' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('data_chiusura', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <!-- Importo sospeso -->
                {!! Form::label('importo_sospeso', 'Importo sospeso' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group">
                        {!! Form::number('importo_sospeso', null, ['class' => 'form-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                    </div>
                </div>
            
                <!-- Data sospeso -->
                {!! Form::label('data_sospeso', 'Data sospeso' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('data_sospeso', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <!-- Stato avanzamento pratica -->
                {!! Form::label('stato_avanzamento', 'Stato avanzamento pratica' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::select('stato_avanzamento', \App\Pratica::$enumStatoAvanzamento, null, ['class' => 'form-control']) !!}
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
                        {!! Form::text('data_sinistro', null, ['class' => 'form-control date-control']) !!}
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
                    {!! Form::select('autorita', \App\Pratica::$enumAutorita, null, ['class' => 'form-control']) !!}
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
                    {!! Form::select('rivalsa', \App\Pratica::$enumRivalsa, null, ['class' => 'form-control']) !!}
                </div>
            
                <!-- Soccorso -->
                {!! Form::label('soccorso', 'Soccorso' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::select('soccorso', \App\Pratica::$enumSoccorso, null, ['class' => 'form-control']) !!}
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
                
                <!-- Note -->
                {!! Form::label('note', 'Note' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <!-- Dinamica -->
                {!! Form::label('dinamica', 'Dinamica' , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::textarea('dinamica', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    @if ($pratica->id)
        <!-- Conferma cambiamenti -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary center-block">
                <i class="fa fa-btn fa-pencil"></i>Modifica pratica
            </button>
        </div>
    @else
        <div class="form-group">
            <button type="submit" class="btn btn-success center-block">
                <i class="fa fa-btn fa-plus"></i>Inserisci pratica
            </button>
        </div>
    @endif
    
{!! Form::close() !!}
<!--</form>-->