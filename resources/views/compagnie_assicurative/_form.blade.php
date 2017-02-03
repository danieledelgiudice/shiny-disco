@if (isset($compagnia_assicurativa))
    {!! Form::model($compagnia_assicurativa, ['action' => ['CompagnieAssicurativeController@update',
        'filiale' => $compagnia_assicurativa->filiale, 'compagnia_assicurativa' => $compagnia_assicurativa],
        'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['action' => ['CompagnieAssicurativeController@store', 'filiale' => $filiale], 'class' => 'form-horizontal']) !!}
@endif
    <div class="panel panel-default">
        <div class="panel-body">
                
            <div class="form-group">
                <!-- Nome Compagnia -->
                {!! Form::label('nome', "Nome" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            
            <div class="form-group">
                <!-- Indirizzo Compagnia -->
                {!! Form::label('indirizzo', "Indirizzo" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('indirizzo', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            
            <div class="form-group">
                <!-- Telefono Compagnia -->
                {!! Form::label('telefono', "Telefono" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                </div>
                
                <!-- Fax Compagnia -->
                {!! Form::label('fax', "Fax" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <!-- Email Compagnia -->
                {!! Form::label('email', "Email" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
                
                <!-- Giorni Compagnia -->
                {!! Form::label('giorni', "Giorni" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('giorni', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    
    @if (isset($compagnia_assicurativa))
        <!-- Conferma cambiamenti -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary center-block">
                <i class="fa fa-btn fa-pencil"></i>Conferma modifica
            </button>
        </div>
    @else
        <div class="form-group">
            <button type="submit" class="btn btn-success center-block">
                <i class="fa fa-btn fa-plus"></i>Aggiungi compagnia assicurativa
            </button>
        </div>
    @endif
    
{!! Form::close() !!}
<!--</form>-->