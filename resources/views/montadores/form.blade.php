<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">MONTADORES</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-8">
                        <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
                            {!! Form::label('nome', 'Nome *', ['class' => 'control-label']) !!}
                            {!! Form::text('nome', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                            {!! Form::label('status', 'Status *', ['class' => 'control-label']) !!}
                            {!! Form::select('status', $status, $statusSelected,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>


                <div class="card-footer">
                    <div class="col-md-2  float-sm-left"><a href="/montadores" class="btn btn-block btn-default">CANCELAR</a></div>
                     <div class="col-md-2  float-sm-right"><button type="submit" class="btn btn-block btn-primary">SALVAR</button></div>
                </div>
            </div>
        </form>
    </div>
</div>

@section('js')

    <script  type="text/javascript">


    </script>
@stop
