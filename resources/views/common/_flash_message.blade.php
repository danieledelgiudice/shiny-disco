@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
    <div class="alert alert-{{ $msg }} alert-dismissible container auto-slide text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ Session::get($msg) }}
    </div>
    @endif
@endforeach