<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">MENU</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('a001_descricao') ? 'has-error' : ''}}">
                            {!! Form::label('a001_descricao', 'Descrição *', ['class' => 'control-label']) !!}
                            {!! Form::text('a001_descricao', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('a001_descricao', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('a001_url') ? 'has-error' : ''}}">
                            {!! Form::label('a001_url', 'Url *', ['class' => 'control-label',  'required' => 'required']) !!}
                            {!! Form::text('a001_url', null,  ['class' => 'form-control',  'maxlength'=>150, ]) !!}
                            {!! $errors->first('a001_url', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('a001_id_pai') ? 'has-error' : ''}}">
                            {!! Form::label('a001_id_pai', 'Menu Principal', ['class' => 'control-label']) !!}
                            {!! Form::select('a001_id_pai', $menus, $menuSelect,  ['class' => 'form-control']) !!}
                            {!! $errors->first('a001_id_pai', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('a001_ordem') ? 'has-error' : ''}}">
                            {!! Form::label('a001_ordem', 'Ordem *', ['class' => 'control-label']) !!}
                            {!! Form::number('a001_ordem', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('a001_ordem', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('a001_status') ? 'has-error' : ''}}">
                            {!! Form::label('a001_status', 'Status *', ['class' => 'control-label']) !!}
                            {!! Form::select('a001_status', $status, $statusSelected,  ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('a001_status', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <div class="col-md-2  float-sm-left"><a href="/menus" class="btn btn-block btn-default">CANCELAR</a></div>
                <div class="col-md-2  float-sm-right"><button type="submit" class="btn btn-block btn-primary">SALVAR</button></div>
            </div>
        </form>
    </div>
</div>

@section('js')

    <script  type="text/javascript">

        $(document).ready(function() {


        });






    </script>
@stop
