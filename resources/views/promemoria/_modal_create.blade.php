<div class="modal fade" tabindex="-1" role="dialog" id="createPromemoriaModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-center modal-title">Aggiungi un nuovo promemoria per la pratica</h4>
            </div>
            {!! Form::open([ 'action' => ['PromemoriaController@store', 'cliente' => $pratica->cliente, 'pratica' => $pratica]]) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('chi', 'Chi:', [ 'class' => 'control-label']) !!}
                        {!! Form::text('chi', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('quando', 'Quando:', [ 'class' => 'control-label']) !!}
                        <div class="input-group date">
                            {!! Form::text('quando', null, ['class' => 'form-control date-control', 'required' => 'required']) !!}
                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('cosa', 'Cosa:', [ 'class' => 'control-label']) !!}
                        {!! Form::text('cosa', null, ['class' => 'form-control', 'required' => 'required']) !!}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary" id="createPromemoriaConfirm">Aggiungi promemoria</button>
                </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->