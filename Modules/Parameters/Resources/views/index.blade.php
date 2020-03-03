@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Parâmetros</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Parâmetros</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Parâmetros</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    {!! Form::open(['url' => '/parameters/create',  'data-toggle' => 'validator', 'files' => true, 'class' => 'form']) !!}
                    <input type="hidden" name="id" value="@if(isset($dataParametro->description)){{$dataParametro->parameter_id}}@endif">
                    <input type="hidden" name="imagem_db" @if(isset($dataParametro)) value="{{$dataParametro->file }}" @endif>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('freight') ? 'has-error' : ''}}">
                                {!! Form::label('freight', 'Frete', ['class' => 'control-label']) !!}
                                {!! Form::text('freight', $dataParametro->freight,  ['class' => 'form-control money',  'maxlength'=>9]) !!}
                                {!! $errors->first('freight', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('taxation') ? 'has-error' : ''}}">
                                {!! Form::label('taxation', 'Imposto', ['class' => 'control-label']) !!}
                                {!! Form::text('taxation', $dataParametro->taxation,  ['class' => 'form-control percent', 'maxlength'=>9]) !!}
                                {!! $errors->first('taxation', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('exchange_rate') ? 'has-error' : ''}}">
                                {!! Form::label('exchange_rate', 'Taxa de Câmbio', ['class' => 'control-label']) !!}
                                {!! Form::text('exchange_rate', $dataParametro->exchange_rate,  ['class' => 'form-control money',  'maxlength'=>9]) !!}
                                {!! $errors->first('exchange_rate', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                {!! Form::label('description', 'Descrição*', ['class' => 'control-label']) !!}
                                <textarea name="description" class="form-control summernote2" required="required">@if(isset($dataParametro)){{$dataParametro->description}}@endif</textarea>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group  {{ $errors->has('file') ? 'has-error' : ''}}">
                                {!! Form::label('file', 'Imagem (300 x 700 - Máx Arquivo 2048 MB)*', ['class' => 'control-label']) !!}
                                <div class="img-bloco">
                                    <div id="image-preview"    @if(isset($dataParametro)) style="background-image: url({{ $dataParametro->file }}); background-position: center;   background-repeat: no-repeat;" @endif>
                                        <label for="image-upload" id="image-label" class="control-label">Selecione um arquivo</label>
                                        <input type="file" name="file" required id="image-upload" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="col-md-2  float-sm-left"><a href="/" class="btn btn-block btn-default">CANCELAR</a></div>
                        <div class="col-md-2  float-sm-right"><button type="submit" class="btn btn-block btn-primary">SALVAR</button></div>
                    </div>
                    {!! Form::close() !!}



                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript" src="{{ asset("/js/jquery.uploadPreview.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/vendor/summernote/summernote-lite.js")}}"></script>
    <script type="text/javascript" src="{{ asset("/vendor/summernote/lang/summernote-pt-BR.js")}}"></script>
    <script  type="text/javascript">

        $( document ).ready(function() {

            $('.money').mask('#.##0,00', {reverse: true});

            $('.percent').mask('##0,00%', {reverse: true});
            $.uploadPreview({
                input_field: "#image-upload",   // Default: .image-upload
                preview_box: "#image-preview",  // Default: .image-preview
                label_field: "#image-label",    // Default: .image-label
                label_default: "Escolha um Arquivo",   // Default: Choose File
                label_selected: "Alterar Arquivo",  // Default: Change File
                no_label: false                 // Default: false
            });


            @if(isset($dataParametro))
            $("#image-upload").removeAttr('required', false);
            @endif

        });

        jQuery(function($) {
            $('.summernote2').summernote({
                placeholder: 'Digite o seu texto',
                tabsize: 2,
                height: 250
            });
        });


    </script>

@stop
