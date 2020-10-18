@if (isset($pagamento))
    {!! Form::model($pagamento, ['action' => ['PagamentiController@update',
        'cliente' => $pagamento->pratica->cliente, 'pratica' => $pagamento->pratica, 'pagamento' => $pagamento],
        'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['action' => ['PagamentiController@store', 'cliente' => $pratica->cliente, 'pratica' => $pratica], 'class' => 'form-horizontal']) !!}
@endif
    <div class="panel panel-default">
        <div class="panel-body">
                
            <div class="form-group">
                <!-- Data Pagamento -->
                {!! Form::label('data', "Data" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('data', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
                
                <!-- Importo Pagamento -->
                {!! Form::label('importo', "Importo" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group">
                        {!! Form::number('importo', null, ['class' => 'form-control', 'step' => '0.01']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <!-- Tipologia Pagamento -->
                {!! Form::label('tipologia', "Tipologia" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('cose'); !!}
                            Cose
                        </label>
                    </div>
                    
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('persone'); !!}
                            Persone
                        </label>
                    </div>
                    
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('spese_mediche'); !!}
                            Spese mediche
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if (isset($pagamento))
        <!-- Conferma cambiamenti -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary center-block">
                <i class="fa fa-btn fa-pencil"></i>Conferma modifica
            </button>
        </div>
    @else
        <div class="form-group">
            <button type="submit" class="btn btn-success center-block">
                <i class="fa fa-btn fa-plus"></i>Aggiungi pagamento
            </button>
        </div>
    @endif
    
{!! Form::close() !!}
<!--</form>-->
