<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open([url()->current(), 'method' => 'GET', 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                <div class="col-md-2 text-right">
                    {!! Form::label('numero_pratica', "Numero Pratica" , ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-chevron-right"></i></span>
                        {!! Form::number('numero_pratica_gt', $request->numero_pratica_gt, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-chevron-left"></i></span>
                        {!! Form::number('numero_pratica_lt', $request->numero_pratica_lt, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    {!! Form::label('mese_apertura', "Mese di apertura" , ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-2">
                    <div class="input-group date month">
                        {!! Form::text('mese_apertura', $request->mese_apertura, ['class' => 'form-control date-control']) !!}
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">
                        <i class="fa fa-fw fa-search"></i>
                    </button>
                    <a class="btn btn-default" href="{{ url()->current() }}">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>