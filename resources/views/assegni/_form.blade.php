@if (isset($assegno))
    {!! Form::model($assegno, ['action' => ['AssegniController@update',
        'cliente' => $assegno->pratica->cliente, 'pratica' => $assegno->pratica, 'assegno' => $assegno],
        'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['action' => ['AssegniController@store', 'cliente' => $pratica->cliente, 'pratica' => $pratica], 'class' => 'form-horizontal']) !!}
@endif
    <div class="panel panel-default">
        <div class="panel-body">
                
            <div class="form-group">
                <!-- Data Assegno -->
                {!! Form::label('data', "Data" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('data', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
                
                <!-- Importo Assegno -->
                {!! Form::label('importo', "Importo" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group">
                        {!! Form::number('importo', null, ['class' => 'form-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                    </div>
                </div>
            </div>
            
            
            <div class="form-group">
                <!-- Banca Assegno -->
                {!! Form::label('banca', "Banca" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::text('banca', null, ['class' => 'form-control']) !!}
                </div>
                
                <!-- Data scadenza -->
                {!! Form::label('data_scadenza', "Scadenza" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('data_scadenza', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <!-- Tipologia Assegno -->
                {!! Form::label('tipologia', "Tipologia" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio('tipologia', '0', old('tipologia') == 0); !!}
                            Da consegnare
                        </label>
                    </div>
                    
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio('tipologia', '1', old('tipologia') == 1); !!}
                            Da restituire
                        </label>
                    </div>
                </div>
                
                <!-- Data azione Assegno -->
                {!! Form::label('data_azione', (isset($assegno) && $assegno->tipologia) ? "Restituito il" : "Consegnato il",
                    ['class' => 'col-md-2 control-label', 'id' => 'label_data_azione']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('data_azione', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if (isset($assegno))
        <!-- Conferma cambiamenti -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary center-block">
                <i class="fa fa-btn fa-pencil"></i>Conferma modifica
            </button>
        </div>
    @else
        <div class="form-group">
            <button type="submit" class="btn btn-success center-block">
                <i class="fa fa-btn fa-plus"></i>Aggiungi assegno
            </button>
        </div>
    @endif
    
{!! Form::close() !!}
<!--</form>-->