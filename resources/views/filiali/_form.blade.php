@include('filiali._modal_conferma_disattivazione')

@if (isset($filiale))
    {!! Form::model($filiale, ['action' => ['FilialiController@update', 'filiale' => $filiale],
        'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['action' => 'FilialiController@store', 'class' => 'form-horizontal']) !!}
@endif
    <div class="panel panel-default">
        <div class="panel-body">
                
            <div class="form-group">
                <!-- Nome filiale -->
                {!! Form::label('nome', "Nome filiale" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <!-- Indirizzo -->
                {!! Form::label('indirizzo', "Indirizzo" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('indirizzo', null, ['class' => 'form-control']) !!}
                </div>
                
                <!-- Telefono -->
                {!! Form::label('telefono', "Telefono" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <!-- Password -->
                {!! Form::label('password', "Password" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci nuova password">
                    <p class="help-block">La password deve essere almeno di 6 caratteri e contenere sia lettere che numeri</p>
                </div>
                
                <!-- Conferma Password -->
                {!! Form::label('password_confirmation', "Conferma Password" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Conferma nuova password">
                </div>
            </div>
            
            @if (isset($utente) &&  $utente != Auth::user()) 
                <div class="form-group" style="padding-right: 15px">
                    @if($utente->isEnabled())
                        <a class="btn btn-danger pull-right" href="#" data-toggle="modal" data-target="#confermaDisattivazioneModal">
                            <i class="fa fa-fw fa-exclamation"></i>Disattiva accesso filiale
                        </a>
                    @else
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#confermaDisattivazioneModal">
                            <i class="fa fa-fw fa-exclamation"></i>Riattiva accesso filiale
                        </a>
                    @endif
                </div>
                <div class="form-group" style="padding-right: 15px">
                    @if($utente->canGenerateLetters())
                        <a class="btn btn-danger pull-right" id="toggleCanGenerateLettersBtn">
                            <i class="fa fa-fw fa-exclamation"></i>Togli permesso di generare lettere
                        </a>
                    @else
                        <a class="btn btn-primary pull-right" id="toggleCanGenerateLettersBtn">
                            <i class="fa fa-fw fa-exclamation"></i>Dai permesso di generare lettere
                        </a>
                    @endif
                    
                </div>
            @endif
        </div>
    </div>
    
    @if (isset($filiale))
        <!-- Conferma cambiamenti -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary center-block">
                <i class="fa fa-btn fa-pencil"></i>Conferma modifica
            </button>
        </div>
    @else
        <div class="form-group">
            <button type="submit" class="btn btn-success center-block">
                <i class="fa fa-btn fa-plus"></i>Aggiungi filiale
            </button>
        </div>
    @endif
    
{!! Form::close() !!}

{!! Form::open(['action' => ['FilialiController@toggleCanGenerateLetters', 'filiale' => $filiale],
    'id' => 'toggleCanGenerateLettersForm', 'method' => 'put']) !!}
{!! Form::close() !!}
<!--</form>-->