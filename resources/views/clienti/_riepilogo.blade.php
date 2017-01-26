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
                <p class="form-control-static">{{ $pratica->cliente->cognome }}</p>
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
                <p class="form-control-static">{{ $pratica->cliente->professione ? $pratica->cliente->professione->nome : '' }}</p>
            </div>
        </div>
        
        
        <div class="row">
            <!-- Reddito -->    
            <strong class="col-md-2 form-control-static">Reddito</strong>
            <div class="col-md-4">
                <p class="form-control-static">{{ format_money($pratica->cliente->reddito) }}</p>
            </div>

        </div>
    </div>
</div>