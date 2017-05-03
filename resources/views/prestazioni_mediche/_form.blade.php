@if ($prestazione_medica->id)
    {!! Form::model($prestazione_medica, ['action' => ['PrestazioniMedicheController@update',
        'cliente' => $prestazione_medica->pratica->cliente, 'pratica' => $prestazione_medica->pratica, 'prestazione_medica' => $prestazione_medica],
        'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['action' => ['PrestazioniMedicheController@store', 'cliente' => $pratica->cliente, 'pratica' => $pratica], 'class' => 'form-horizontal']) !!}
@endif
    <div class="panel panel-default">
        <div class="panel-body">
            
            <div class="form-group">
                <!-- Nome medico -->
                {!! Form::label('nome_medico', "Nome Medico" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('nome_medico', null, ['class' => 'form-control']) !!}
                </div>
            </div>
                
            <div class="form-group">
                <!-- Data -->
                {!! Form::label('data', "Data" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group date">
                        {!! Form::text('data', null, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
                
                <!-- Giorni -->
                {!! Form::label('giorni', "Giorni" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    {!! Form::number('giorni', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            
            <div class="form-group">
                <!-- Costo -->
                {!! Form::label('costo', "Costo" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group">
                        {!! Form::number('costo', null, ['class' => 'form-control', 'min' => '0', 'step' => '0.01']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                    </div>
                </div>
                
                <!-- Tipologia -->
                {!! Form::label('tipologia', "Tipologia" , ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-4">
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio('inConvenzione', '1', ( old('inConvenzione') == '1' || (old('inConvenzione') == '' && $prestazione_medica->inConvenzione))) !!}
                            In convenzione
                        </label>
                    </div>
                    
                    <div class="radio-inline">
                        <label>
                            {!! Form::radio('inConvenzione', '0', ( old('inConvenzione') == '0' || (old('inConvenzione') == '' && !$prestazione_medica->inConvenzione))) !!}
                            Non in convenzione
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group" id="group-inConvenzione" style="{{ ( old('inConvenzione') == 1 || (old('inConvenzione') == '' && $prestazione_medica->inConvenzione)) ? '' : 'display: none' }}" >
                <!-- Percentuale -->
                {!! Form::label('percentuale', "Percentuale" , ['class' => 'col-md-2 col-md-offset-6 control-label']) !!}
                <div class="col-md-4">
                    <div class="input-group">
                        {!! Form::number('percentuale', null, ['class' => 'form-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-percent"></i></span>
                    </div>
                </div>
                </div>
            
            <div class="form-group">
                <!-- Pagato -->
                <div class="col-md-3 col-md-offset-2">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('pagato', '1', null) !!}
                            Pagato
                        </label>
                    </div>
                </div>
                <!-- Sospeso -->
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('sospeso', '1', null) !!}
                            Sospeso
                        </label>
                    </div>
                </div>
                <!-- Fattura -->
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('fattura', '1', null) !!}
                            Fattura
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if ($prestazione_medica->id)
        <!-- Conferma cambiamenti -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary center-block">
                <i class="fa fa-btn fa-pencil"></i>Conferma modifica
            </button>
        </div>
    @else
        <div class="form-group">
            <button type="submit" class="btn btn-success center-block">
                <i class="fa fa-btn fa-plus"></i>Aggiungi prestazione medica
            </button>
        </div>
    @endif
    
{!! Form::close() !!}
<!--</form>-->