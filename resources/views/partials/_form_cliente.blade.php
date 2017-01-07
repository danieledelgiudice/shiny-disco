@if (isset($cliente))
    {!! Form::model($cliente, ['action' => ['ClientiController@update', $cliente], 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['action' => ['ClientiController@store'], 'class' => 'form-horizontal']) !!}
@endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-id-card"></i>
            &nbsp;
            Dati anagrafici
        </div>
    
        <div class="panel-body">
                
            <div class="form-group">
                
                <!-- Nome Cliente -->
                {!! Form::label('nome', "Nome" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                </div>
                
                <!-- Cognome Cliente -->
                {!! Form::label('cognome', "Cognome" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('cognome', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            
            <div class="form-group">
                <!-- Città di nascita Cliente -->
                {!! Form::label('citta_nascita', "Città di nascita" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('citta_nascita', null, ['class' => 'form-control']) !!}
                </div>
                
                <!-- Data di nascita Cliente -->
                {!! Form::label('data_nascita', "Data di nascita" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('data_nascita', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            
            
            <div class="form-group">
                <!-- Sesso Cliente -->    
                {!! Form::label('sesso', "Sesso" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {{ Form::select('sesso', \App\Cliente::$enumSesso, null, ['class' => 'form-control']) }}
                </div>
    
                
                <!-- Codice Fiscale Cliente -->
                {!! Form::label('codice_fiscale', "Codice Fiscale" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('codice_fiscale', null, ['class' => 'form-control', 'maxlength' => '16']) !!}
                </div>
            </div>
        </div>
    </div>
                
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-road"></i>
            &nbsp;
            Indirizzo residenza
        </div>
    
        <div class="panel-body">
                
            <div class="form-group">
                <!-- Via Cliente -->
                {!! Form::label('via', "Via" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('via', null, ['class' => 'form-control']) !!}
                </div>
            
                <!-- Città di residenza Cliente -->
                {!! Form::label('citta_residenza', "Città di residenza" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('citta_residenza', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <!-- Provincia Cliente -->
                {!! Form::label('provincia', "Provincia" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('provincia', null, ['class' => 'form-control', 'maxlength' => '2']) !!}
                </div>
                
                <!-- CAP Cliente -->
                {!! Form::label('cap', "CAP" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('cap', null, ['class' => 'form-control', 'maxlength' => '5' ]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-phone"></i>
            &nbsp;
            Recapiti
        </div>
        <div class="panel-body">
            <div class="form-group">
                <!-- Cellulare Cliente -->
                {!! Form::label('cellulare', "Cellulare" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('cellulare', null, ['class' => 'form-control']) !!}
                </div>
            
                <!-- Telefono Cliente -->
                {!! Form::label('telefono', "Telefono" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <!-- Email Cliente -->
                {!! Form::label('email', "Email" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
            
                <!-- FAX Cliente -->
                {!! Form::label('fax', "FAX" , ['class' => 'col-md-2 control-label']) !!}
            
                <div class="col-md-4">
                    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-info"></i>
            &nbsp;
            Documenti
        </div>
        <div class="panel-body">                            
                
            <div class="form-group">
                <!-- P. IVA Cliente -->
                {!! Form::label('partita_iva', "P. IVA" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('partita_iva', null, ['class' => 'form-control']) !!}
                </div>
                
                <!-- Stato civile Cliente -->
                {!! Form::label('stato_civile', "Stato civile" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {{ Form::select('stato_civile', \App\Cliente::$enumStatoCivile, null, ['class' => 'form-control']) }}
                </div>
            
                
            </div>
            
            
            <div class="form-group">
                <!-- Tipo documento Cliente -->
                {!! Form::label('tipo_documento', "Tipo documento" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {{ Form::select('tipo_documento', \App\Cliente::$enumTipoDocumento, null, ['class' => 'form-control']) }}
                </div>
                
                <!-- Numero documento Cliente -->
                {!! Form::label('numero_documento', "Numero documento" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('numero_documento', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            
            <div class="form-group">
                <!-- Reddito Cliente -->
                {!! Form::label('reddito', "Reddito" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group">
                        {!! Form::number('reddito', null, ['class' => 'form-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                    </div>
                </div>
            
                <!-- Numero Card Cliente -->
                {!! Form::label('numero_card', "Numero Card" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('numero_card', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <!-- Note Cliente -->
                {!! Form::label('note', "Note" , ['class' => 'col-md-2 control-label']) !!}
            
                <div class="col-md-10">
                    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    
    @if (isset($cliente))
        <!-- Conferma cambiamenti -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary center-block">
                <i class="fa fa-btn fa-pencil"></i>Modifica cliente
            </button>
        </div>
    @else
        <div class="form-group">
            <button type="submit" class="btn btn-success center-block">
                <i class="fa fa-btn fa-plus"></i>Inserisci cliente
            </button>
        </div>
    @endif
    
{!! Form::close() !!}
<!--</form>-->