<div class="modal fade" tabindex="-1" role="dialog" id="{{ $resource }}DestroyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-center modal-title">Attenzione!</h4>
            </div>
                <div class="modal-body text-center">
                <p>{{ $message }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-danger" id="{{ $resource }}DestroyConfirm">Elimina {{ $resource }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->