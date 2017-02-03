<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-id-card"></i>
        &nbsp;
        Dati anagrafici
    </div>

    <div class="panel-body">
            
        <div class="row">
            <!-- Cognome Cliente -->
            <strong class="col-md-2 form-control-static">Cognome</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->cognome }}</p>
            </div>
            
            <!-- Nome Cliente -->
            <strong class="col-md-2 form-control-static">Nome</strong>
            <div class="col-md-4">
                <p class="form-control-static">{{ $cliente->nome }}</p>
            </div>
        </div>
        
        
        <div class="row">
            <!-- Città di nascita Cliente -->
            <strong class="col-md-2 form-control-static">Città di nascita</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->citta_nascita }}</p>
            </div>
            
            <!-- Data di nascita Cliente -->
            <strong class="col-md-2 form-control-static">Data di nascita</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ format_date($cliente->data_nascita) }}</p>
            </div>
        </div>
        
        
        <div class="row">
            <!-- Sesso Cliente -->    
            <strong class="col-md-2 form-control-static">Sesso</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ isset(\App\Cliente::$enumSesso[$cliente->sesso]) ? \App\Cliente::$enumSesso[$cliente->sesso] : '' }}</p>
            </div>

            
            <!-- Codice Fiscale Cliente -->
            <strong class="col-md-2 form-control-static">Codice Fiscale</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->codice_fiscale }}</p>
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
            
        <div class="row">
            <!-- Via Cliente -->
            <strong class="col-md-2 form-control-static">Via</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->via }}</p>
            </div>
        
            <!-- Città di residenza Cliente -->
            <strong class="col-md-2 form-control-static">Città di residenza</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->citta_residenza }}</p>
            </div>
        </div>
        
        <div class="row">
            <!-- Provincia Cliente -->
            <strong class="col-md-2 form-control-static">Provincia</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->provincia }}</p>
            </div>
            
            <!-- CAP Cliente -->
            <strong class="col-md-2 form-control-static">CAP</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->cap }}</p>
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
        <div class="row">
            <!-- Cellulare Cliente -->
            <strong class="col-md-2 form-control-static">Cellulare</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->cellulare }}</p>
            </div>
        
            <!-- Telefono Cliente -->
            <strong class="col-md-2 form-control-static">Telefono</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->telefono }}</p>
            </div>
        </div>
        
        <div class="row">
            <!-- Email Cliente -->
            <strong class="col-md-2 form-control-static">Email</strong>
            <div class="col-md-4">
                <a href="mailto:{{ $cliente->email }}">
                    <p value="" class="form-control-static">{{ $cliente->email }}</p>    
                </a>
            </div>
        
            <!-- FAX Cliente -->
            <strong class="col-md-2 form-control-static">FAX</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->fax }}</p>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info"></i>
        &nbsp;
        Ulteriori informazioni
    </div>
    <div class="panel-body">                            
            
        <div class="row">
            <!-- P. IVA Cliente -->
            <strong class="col-md-2 form-control-static">P. IVA</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->partita_iva }}</p>
            </div>
            
            <!-- Stato civile Cliente -->
            <strong class="col-md-2 form-control-static">Stato civile</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ isset(\App\Cliente::$enumStatoCivile[$cliente->stato_civile]) ? \App\Cliente::$enumStatoCivile[$cliente->stato_civile] : '' }}</p>
            </div>
        
            
        </div>
        
        
        <div class="row">
            <!-- Tipo documento Cliente -->
            <strong class="col-md-2 form-control-static">Tipo documento</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ isset(\App\Cliente::$enumTipoDocumento[$cliente->tipo_documento]) ? \App\Cliente::$enumTipoDocumento[$cliente->tipo_documento] : '' }}</p>
            </div>
            
            <!-- Numero documento Cliente -->
            <strong class="col-md-2 form-control-static">Numero documento</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->numero_documento }}</p>
            </div>
        </div>
        
        <div class="row">
            <!-- Professione Cliente -->
            <strong class="col-md-2 form-control-static">Professione</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->professione ? $cliente->professione->nome : '' }}</p>
            </div>
        
            <!-- Dettagli professione Cliente -->
            <strong class="col-md-2 form-control-static">Dettagli professione</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->dettagli_professione }}</p>
            </div>
        </div>
        
        <div class="row">
            <!-- Reddito Cliente -->
            <strong class="col-md-2 form-control-static">Reddito</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ format_money($cliente->reddito) }}</p>
            </div>
        
            <!-- Numero Card Cliente -->
            <strong class="col-md-2 form-control-static">Numero Card</strong>
            <div class="col-md-4">
                <p value="" class="form-control-static">{{ $cliente->numero_card }}</p>
            </div>
        </div>
        
        <div class="row">
            <!-- Note Cliente -->
            <strong class="col-md-2 form-control-static">Note</strong>
            <div class="col-md-10">
                <p value="" class="form-control-static">{{ $cliente->note }}</p>
            </div>
        </div>
    </div>
</div>