<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">PRODUTO</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name', 'Nome*', ['class' => 'control-label']) !!}
                            {!! Form::text('name', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('store_id') ? 'has-error' : ''}}">
                            {!! Form::label('store_id', 'Loja*', ['class' => 'control-label']) !!}
                            {!! Form::select('store_id', $stores, null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('store_id', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('variation') ? 'has-error' : ''}}">
                            {!! Form::label('variation', 'Variação', ['class' => 'control-label']) !!}
                            {!! Form::text('variation', null,  ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('variation', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group  {{ $errors->has('file') ? 'has-error' : ''}}">
                            {!! Form::label('file', 'Imagem (Máx Arquivo 2048 MB)', ['class' => 'control-label']) !!}
                            <div class="img-bloco">
                                <div id="image-preview"    @if(isset($product)) style="background-image: url({{ $product->file }}); background-position: center;   background-repeat: no-repeat;" @endif>
                                    <label for="image-upload" id="image-label" class="control-label">Selecione um arquivo</label>
                                    <input type="file" name="file" id="image-upload" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                {!! Form::label('price', 'Preço*', ['class' => 'control-label']) !!}
                                {!! Form::text('price', null,  ['class' => 'form-control money',  'maxlength'=>9]) !!}
                                {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('backorder') ? 'has-error' : ''}}">
                                {!! Form::label('backorder', 'Backorder', ['class' => 'control-label']) !!}
                                {!! Form::select('backorder', $backOrder, $backOrderSelected,  ['class' => 'form-control', 'maxlength'=>9]) !!}
                                {!! $errors->first('backorder', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                {!! Form::label('status', 'Status*', ['class' => 'control-label']) !!}
                                {!! Form::select('status', $status, $statusSelected,  ['class' => 'form-control', 'required' => 'required']) !!}
                                {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="card-footer">
                    <div class="col-md-2  float-sm-left"><a href="/products" class="btn btn-block btn-default">CANCELAR</a></div>
                    <div class="col-md-2  float-sm-right"><button type="submit" class="btn btn-block btn-mypharma">SALVAR</button></div>
                </div>
            </div>
        </form>
    </div>
</div>

@section('js')
    <script type="text/javascript" src="{{ asset("/js/jquery.uploadPreview.js") }}"></script>
    <script  type="text/javascript">
        $( document ).ready(function() {

            $('.money').mask('#.##0,00', {reverse: true});

            $.uploadPreview({
                input_field: "#image-upload",   // Default: .image-upload
                preview_box: "#image-preview",  // Default: .image-preview
                label_field: "#image-label",    // Default: .image-label
                label_default: "Escolha um Arquivo",   // Default: Choose File
                label_selected: "Alterar Arquivo",  // Default: Change File
                no_label: false                 // Default: false
            });

        });

    </script>
@stop
