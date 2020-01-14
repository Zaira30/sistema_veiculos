<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">VEÍCULO</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
                            {!! Form::label('nome', 'Modelo *', ['class' => 'control-label']) !!}
                            {!! Form::text('nome', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('montador_id') ? 'has-error' : ''}}">
                            {!! Form::label('montador_id', 'Montador *', ['class' => 'control-label']) !!}
                            {!! Form::select('montador_id', $montadores,null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('montador_id', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('chassi') ? 'has-error' : ''}}">
                            {!! Form::label('chassi', 'Chassi *', ['class' => 'control-label']) !!}
                            {!! Form::text('chassi', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('chassi', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('ano_fabricacao') ? 'has-error' : ''}}">
                            {!! Form::label('ano_fabricacao', 'Ano de Fabricação *', ['class' => 'control-label']) !!}
                            {!! Form::number('ano_fabricacao', null,  ['class' => 'form-control',  'maxlength'=>4, 'required' => 'required']) !!}
                            {!! $errors->first('ano_fabricacao', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('ano_modelo') ? 'has-error' : ''}}">
                            {!! Form::label('ano_modelo', 'Ano do Modelo *', ['class' => 'control-label']) !!}
                            {!! Form::number('ano_modelo', null,  ['class' => 'form-control',  'maxlength'=>4, 'required' => 'required']) !!}
                            {!! $errors->first('ano_modelo', '<p class="help-block">:message</p>') !!}
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
                    <div class="col-md-2  float-sm-left"><a href="/veiculos" class="btn btn-block btn-default">CANCELAR</a></div>
                     <div class="col-md-2  float-sm-right"><button type="submit" class="btn btn-block btn-primary">SALVAR</button></div>
                </div>
            </div>
        </form>
    </div>
</div>

@section('js')

    <script  type="text/javascript">

        $(document).ready(function() {
            $('#ano_modelo').mask('0000');
            $('#ano_fabricacao').mask('0000');

        });

        $('#ano_fabricacao').change(function() {
            var ano_fabricacao = $(this).val().length;

            if(ano_fabricacao < 4) {
                alert('Ano de fabricação com 4 dígitos');
                $('#ano_fabricacao').val('');

            }
        });

        $('#ano_modelo').change(function() {
            var ano_modelo = $(this).val().length;

            if(ano_modelo < 4) {
                alert('Ano do Modelo com 4 dígitos');
                $('#ano_modelo').val('');

            }
        });
    </script>
@stop
