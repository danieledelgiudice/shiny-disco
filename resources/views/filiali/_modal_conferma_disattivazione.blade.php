<div class="modal fade" tabindex="-1" role="dialog" id="confermaDisattivazioneModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-center modal-title">Attenzione!</h4>
            </div>
                <div class="modal-body text-center">
                <p>Sei sicuro di voler {{ $utente->isEnabled()? 'disattivare' : 'riattivare' }} la filiale?</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['action' => ['FilialiController@toggleEnabled', 'filiale' => $filiale], 'method' => 'put', 'id' => 'confermaDisattivazioneForm']) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                    @if ($utente->isEnabled())
                        <button type="submit" class="btn btn-danger">Disattiva</button>
                    @else
                        <button type="submit" class="btn btn-primary">Riattiva</button>
                    @endif
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->