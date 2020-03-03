<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">ORÇAMNETO</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('number_budget') ? 'has-error' : ''}}">
                            {!! Form::label('number_budget', 'Nº Orçamento*', ['class' => 'control-label']) !!}
                            {!! Form::text('number_budget', $codigo,   ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('number_budget', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('cpf') ? 'has-error' : ''}}">
                            {!! Form::label('cpf', 'CPF*', ['class' => 'control-label']) !!}
                            {!! Form::text('cpf', null,  ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('cpf', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name', 'Nome*', ['class' => 'control-label']) !!}
                            {!! Form::text('name', null,  ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            {!! Form::label('email', 'E-mail*', ['class' => 'control-label']) !!}
                            {!! Form::email('email', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                            {!! Form::label('phone', 'Telefone*', ['class' => 'control-label']) !!}
                            {!! Form::text('phone', null,  ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('doctor') ? 'has-error' : ''}}">
                            {!! Form::label('doctor', 'Médico*', ['class' => 'control-label']) !!}
                            {!! Form::text('doctor', null,  ['class' => 'form-control', 'required' => 'required', 'maxlength'=>150]) !!}
                            {!! $errors->first('doctor', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('store_id') ? 'has-error' : ''}}">
                            {!! Form::label('store_id', 'Loja', ['class' => 'control-label']) !!}
                            {!! Form::select('store_id',  $stores, null, ['class' => 'form-control select2']) !!}
                            {!! $errors->first('store_id', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors "></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
                            {!! Form::label('product_id', 'Produto*', ['class' => 'control-label']) !!}
                            {!! Form::select('product_id',  $products, $productSelect, ['class' => 'form-control select2']) !!}
                            {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors "></div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group {{ $errors->has('variation') ? 'has-error' : ''}}">
                            {!! Form::label('variation', 'Variação*', ['class' => 'control-label']) !!}
                            {!! Form::text('variation',  null, ['class' => 'form-control select2', 'maxlength'=>150]) !!}
                            {!! $errors->first('variation', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors "></div>
                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                            {!! Form::label('price', 'Preço*', ['class' => 'control-label']) !!}
                            {!! Form::text('price',  null, ['class' => 'form-control money', 'maxlength'=>150]) !!}
                            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors "></div>
                        </div>
                    </div>


                    <div class="col-md-1">
                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
                            {!! Form::label('quantity', 'Quantidade*', ['class' => 'control-label']) !!}
                            {!! Form::text('quantity', null, ['class' => 'form-control valorMaskFator', 'maxlength'=>150]) !!}
                            {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors "></div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label"></label>
                            <div style="margin-top: 6px;">
                                <a class="btn btn-primary btn-mypharma pull-right" href="javascript: addTableKit('product_id', 'variation', 'price', 'quantity', 'table-Kit-Produto');" style="width: 100%;">
                                    <i class="fa fa-plus"> Adicionar</i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 44px;">
                    <div class="col-md-12">

                        <div class="box">

                            <div class="box-body table-responsive no-padding">

                                <table class="table table-hover" id="table-Kit-Produto" width="100%">

                                    <tr>
                                        <th style="width: 40%">Produto</th>
                                        <th style="width: 30%">Variacao</th>
                                        <th style="width: 10%">Preço</th>
                                        <th style="width: 20%">Qnt.</th>
                                        <th style="width: 40px">Excluir</th>
                                    </tr>


                                    @if (isset($budget->budgetProduct))
                                        @foreach ($budget->budgetProduct as $row)

                                          <tr class="dados_id_{{ $row->budget_product_id }} valores_{{$row->product_id}}_{{$row->quantity}}" id="{{ $row->a020_id_kitproduto }}">

                                                <td>
                                                    {{ $row->produto->name }} <input type="hidden" name="product_id[]" value="{{ $row->produto->product_id }}">
                                                </td>

                                              <td>{{ $row->produto->variation }} <input type="hidden" name="variation[]" value="{{ $row->produto->variation }}"></td>
                                              <td>{{ $row->produto->price }} <input type="hidden" name="price[]"  class="price2" value="{{ $row->produto->price }}"></td>

                                                <td><span class="table-Kit-Produto{{ $row->budget_product_id }}">{{ $row->quantity }}</span>
                                                    <input type="text" name="quantity[]" class="editarCampo valorMaskFator" value="{{ $row->quantity  }}" id="table-Kit-Produto{{  $row->budget_product_id  }}" size="2" style="display: none;width: 110px;">
                                                    &nbsp;&nbsp;
                                                    <div class="btn btn-success" onclick="editCampo('table-Kit-Produto', '{{ $row->budget_product_id }}')"><i class="fa fa-edit" aria-hidden="true" disabled = ''></i></div>
                                                </td>
                                                <td>
                                                    <div class="btn btn-danger" onclick="removeLinhaTable('Têm certeza que deseja excluir este Produto?', 'table-Kit-Produto', id='{{ $row->budget_product_id }}')"><i class="far fa-trash-alt" aria-hidden="true"></i></div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </table>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-2  float-sm-right">
                        <a href="#" onclick="calculo()" class="btn btn-block btn-danger">CALCULAR</a>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('taxation') ? 'has-error' : ''}}">
                            {!! Form::label('taxation', 'Imposto', ['class' => 'control-label']) !!}
                            {!! Form::text('taxation',  $parametros->taxation,  ['class' => 'form-control percent', 'maxlength'=>150, 'readonly' => true]) !!}
                            {!! $errors->first('taxation', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors "></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('freight') ? 'has-error' : ''}}">
                            {!! Form::label('freight', 'Frete', ['class' => 'control-label']) !!}
                            {!! Form::text('freight',  $parametros->freight, ['class' => 'form-control money', 'maxlength'=>150, 'readonly' => true]) !!}
                            {!! $errors->first('freight', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors "></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
                            {!! Form::label('total', 'Total', ['class' => 'control-label']) !!}
                            {!! Form::text('total',  null, ['class' => 'form-control money', 'maxlength'=>150, 'readonly' => true]) !!}
                            {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors "></div>
                        </div>
                    </div>

                </div>


                <div class="card-footer">
                    <div class="col-md-2  float-sm-left"><a href="/budget" class="btn btn-block btn-default">CANCELAR</a></div>
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
            $('#cpf').mask('000.000.000-00');
            $('.percent').mask('##0,00%', {reverse: true});

            $('.valorMaskFator').mask("999999999");

            $.uploadPreview({
                input_field: "#image-upload",   // Default: .image-upload
                preview_box: "#image-preview",  // Default: .image-preview
                label_field: "#image-label",    // Default: .image-label
                label_default: "Escolha um Arquivo",   // Default: Choose File
                label_selected: "Alterar Arquivo",  // Default: Change File
                no_label: false                 // Default: false
            });

            @if(isset($budget))
             $("#store_id").removeAttr('required', false);
             
                @if($budget->total != null || $budget->total != "")
                    $("#freight").val("");
                @endif
            @endif


        });


        $("#cpf").change( function () {

            var cpf = $("#cpf").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                url: '{!! route('budget.getCpf') !!}',
                data: {
                    'cpf' : cpf
                },
                dataType: "JSON",
                success: function(response){

                    if(response) {
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#phone').val(response.phone);
                    }

                },
            });

        });

        $('#phone').keyup(function() {
            var telefone = $(this).val().replace(/\D/g, '').length;
            if(telefone > 10){
                $('#phone').mask('(00) 00000-0000');
            }else{
                $('#phone').mask('(00) 0000-00009');
            }
        });

        function addTableKit(input01, input02, input03, input04,nomeTabela)
        {
            /****** Pega os valores dos inputs ****/
            var valorInput01 = $('#'+input01).val();
            var valorInput02 = $('#'+input02).val();
            var valorInput03 = $('#'+input03).val();
            var valorInput04 = $('#'+input04).val();
            var name         = $('#'+input01).find(":selected").text();

            var retorno = name.split("-");

            var produto_id = valorInput01;
            var variation = valorInput02;
            var price = valorInput03;
            var quantity = valorInput04;
            var produto = retorno[0];
            var codigo   = retorno[1];


            if($('#'+input01).val() =="" ){
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor adicionar um Produto!',
                });
                return;
            }

            if($('#'+input02).val() =="" ){
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Favor adicionar a quantidade!',
                });
                return;
            }


            var linha = '';
            if ($(".bg_add_linha").length >0 ){
                linha = $(".bg_add_linha").length + 1
            }else{
                linha = 1;
            }

            /****** Verifica se os valores já estão na tabela ****/
            if(!$('#'+nomeTabela+' tr').hasClass('valores_'+valorInput01+'_'+valorInput02+'_'+valorInput03)){
                var addLinha ="";

                addLinha = addLinha + '<tr class="dados_id_'+linha+' bg_add_linha valores_'+valorInput01+'_'+valorInput02+'_'+valorInput03+'">'
                addLinha = addLinha + ' <td width="30%">'+produto+'<input type="hidden" name="product_id[]"  value="'+valorInput01+'"></td>'
                addLinha = addLinha + ' <td width="200">'+variation+'<input type="hidden" name="variation[]" value="'+valorInput02+'"></td>'
                addLinha = addLinha + ' <td width="10%">'+price+'<input type="hidden" class="price2" name="price[]" value="'+valorInput03+'"></td>'
                addLinha = addLinha + ' <td width="10%"><span class="table-Kit-Produto'+linha+'">'+valorInput04+'</span><input type="text" class="editarCampo valorMaskFator" name="quantity[]"  size="2"  maxlength="12"  style="display:none;width: 110px;"  value="'+valorInput04+'" id="'+nomeTabela+linha+'">' +
                    '&nbsp;&nbsp; <div class="btn btn-success" onclick="editCampo(\''+nomeTabela+'\',\''+linha+'\')"><i class="fa fa-edit" aria-hidden="true"></i></div></td>';
                addLinha = addLinha + '<td>' +
                    '<div class="btn btn-danger" onclick="removeLinhaTable(\'Têm certeza que deseja excluir este Produto?\',\''+nomeTabela+'\',\''+linha+'\')"><i class="far fa-trash-alt" aria-hidden="true"></i></div></td></tr>';
                $('#'+nomeTabela).append(addLinha);
                $('.valorMaskFator').mask("999999999");



                $("#enviar").attr("disabled", false);
                $novoValor = parseInt($('#num_row').val()) +1;

                var valor = valorInput03 *  $("#"+nomeTabela+linha).val();


                $('#num_row').val($novoValor);
            }else{

                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Este Produto já foi adicionado!',
                });

            }

            /***** Resentando os valores dos campos ******/
            $('#'+input01).val('');
            $("#select2-a018_codigo_produto-container").html("");
            // $('#'+input01).html('');
            $('#'+input02).val('');
            $('#'+input03).val('');
            $('#'+input04).val('');


        }



        function removeLinhaTable (string,nomeTabela,idLinhaTable){

            $.confirm({
                theme: 'light',
                title: 'ALERTA',
                content: string,
                buttons: {
                    confirm:{
                        text: 'Excluir',
                        btnClass: 'btn-danger',
                        action: function(){

                            $('#'+nomeTabela+' .dados_id_'+idLinhaTable).remove();

                            $novoValor = parseInt($('#num_row').val()) -1;
                            $('#num_row').val($novoValor);

                            if($('#num_row').val() <= 0) {
                                $("#enviar").attr("disabled", true);
                            }
                        }
                    },
                    cancel:{
                        text: 'Cancelar',
                    }
                }
            });
        }

        function editCampo(nomeTabela, idLinhaTable)
        {
            $(this).hide();
            //   $('#percentualId').hide();
            $('.'+nomeTabela+idLinhaTable).hide();
            $('#'+nomeTabela+idLinhaTable).show();
            //  porcentualMaskAtivar();
        }


        $("#store_id").change( function () {
            var store_id = $("#store_id").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                url: '{!! route('budget.getproducts') !!}',
                data: {
                    'store_id' : store_id
                },
                dataType: "JSON",
                success: function(response){

                    $("#product_id").html("");
                    $('#variation').val("");
                    $('#price').val("");
                    $('#quantity').html("");
                    $("#product_id").append( '<option value=""></option>' );
                    $.each(response, function(key, value) {
                        $("#product_id").append( '<option value="'+value.product_id+'">'+ value.name+'</option>' );

                    });

                },
            });
        });


        $("#product_id").change( function () {

            var product_id = $("#product_id").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                url: '{!! route('budget.getDataProduto') !!}',
                data: {
                    'product_id' : product_id
                },
                dataType: "JSON",
                success: function(response){

                    if(response) {
                        $('#variation').val(response.variation);
                        $('#price').val(response.price);
                    }
                },
            });

        });


        function  calculo()
        {
            $("#total").val("");
            var total = 0;
            var subTotal = 0;
            var qnt = 0;
            var frete = 0;

            $('.price2').each(function(i, obj) {

                qnt = $("input[name='quantity[]']").get(i).value;
                subTotal = parseFloat( $(obj).val()) * parseFloat(qnt);
                total = parseFloat(subTotal) + parseFloat(total);
            });

            if(total >300) {

                $("#freight").val("");
                $.alert({
                    theme: 'light',
                    title: 'ALERTA',
                    content: 'Frete Grátis!',
                });
            } else {

                frete = <?=$parametros->freight?>;
            }

            var percentual = <?=$parametros->taxation?>;
            var percentualCalculo = Math.round(total*(percentual/100));

            var soma = parseFloat(total) + parseFloat(percentualCalculo);
            var soma = parseFloat(soma) +  parseFloat(frete);

            console.log(soma);

            $("#total").val(parseFloat(soma));
        }

    </script>
@stop
