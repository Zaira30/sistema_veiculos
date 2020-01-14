<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">MARCA</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-8">
                        <div class="form-group {{ $errors->has('a004_descricao') ? 'has-error' : ''}}">
                            {!! Form::label('a004_descricao', 'Descrição *', ['class' => 'control-label']) !!}
                            {!! Form::text('a004_descricao', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('a004_descricao', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('a004_status') ? 'has-error' : ''}}">
                            {!! Form::label('a004_status', 'Status *', ['class' => 'control-label']) !!}
                            {!! Form::select('a004_status', $status, $statusSelected,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('a004_status', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>


                <div class="card-footer">
                    <div class="col-md-2  float-sm-left"><a href="/marcas" class="btn btn-block btn-default">CANCELAR</a></div>
                    @if(Auth::user()->can('create-marcas') || Auth::user()->can('edit-marcas'))
                        <div class="col-md-2  float-sm-right"><button type="submit" class="btn btn-block btn-primary">SALVAR</button></div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

@section('js')

    <script  type="text/javascript">


    </script>
@stop
