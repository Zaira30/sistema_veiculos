<!-- general form elements -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">USUÁRIO</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('tipo_usuario') ? 'has-error' : ''}}">
                            {!! Form::label('tipo_usuario', 'Tipo Usuário *', ['class' => 'control-label']) !!}
                            {!! Form::select('tipo_usuario', $tipoPessoa, $tipoPessoaSelected,  ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('tipo_usuario', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-sm-3">

                        <div class="form-group {{ $errors->has('cnpj_cpf') ? 'has-error' : ''}}">
                            {!! Form::label('cnpj_cpf', 'CNPJ/CPF *', ['class' => 'control-label']) !!}
                            {!! Form::text('cnpj_cpf', null,  ['class' => 'form-control cpfcnpj',  'maxlength'=>20, 'required' => 'required']) !!}
                            {!! $errors->first('cnpj_cpf', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors erro_cpfcnpj"></div>
                        </div>

                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name', 'Nome *', ['class' => 'control-label']) !!}
                            {!! Form::text('name', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            {!! Form::label('email', 'E-mail *', ['class' => 'control-label']) !!}
                            {!! Form::email('email', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('cep') ? 'has-error' : ''}}">
                            {!! Form::label('cep', 'CEP', ['class' => 'control-label']) !!}
                            {!! Form::text('cep', null,  ['class' => 'form-control',  'maxlength'=>10]) !!}
                            {!! $errors->first('cep', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('bairro') ? 'has-error' : ''}}">
                            {!! Form::label('bairro', 'Bairro', ['class' => 'control-label']) !!}
                            {!! Form::text('bairro', null,  ['class' => 'form-control',  'maxlength'=>150]) !!}
                            {!! $errors->first('bairro', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('cidade') ? 'has-error' : ''}}">
                            {!! Form::label('cidade', 'Cidade', ['class' => 'control-label']) !!}
                            {!! Form::text('cidade', null,  ['class' => 'form-control',  'maxlength'=>150]) !!}
                            {!! $errors->first('cidade', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('estado') ? 'has-error' : ''}}">
                            {!! Form::label('estado', 'Estado', ['class' => 'control-label']) !!}
                            {!! Form::text('estado', null,  ['class' => 'form-control',  'maxlength'=>150]) !!}
                            {!! $errors->first('estado', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('endereco') ? 'has-error' : ''}}">
                            {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
                            {!! Form::text('endereco', null,  ['class' => 'form-control',  'maxlength'=>150]) !!}
                            {!! $errors->first('endereco', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('numero') ? 'has-error' : ''}}">
                            {!! Form::label('numero', 'Número', ['class' => 'control-label']) !!}
                            {!! Form::text('numero', null,  ['class' => 'form-control',  'maxlength'=>150]) !!}
                            {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('complemento') ? 'has-error' : ''}}">
                            {!! Form::label('complemento', 'Complemento', ['class' => 'control-label']) !!}
                            {!! Form::text('complemento', null,  ['class' => 'form-control',  'maxlength'=>150]) !!}
                            {!! $errors->first('complemento', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                            {!! Form::label('status', 'Status *', ['class' => 'control-label']) !!}
                            {!! Form::select('status', $status, $statusSelected,  ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 style="color:#027afd">LISTA DE PERFIS</h6>
                    </div>
                    <div class="col-md-6">
                        <h6 style="color:#027afd">LISTA DE PERFIS SELECIONADOS</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box1 col-md-12">
                            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                                {!! Form::select('role_id[]', $perfils, $perfilSelected,  ['class' => 'form-control', 'required' => 'required', 'id' => 'selectList', 'multiple' => 'multiple' ]) !!}
                                {!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <div class="col-md-2  float-sm-left"><a href="/usuarios" class="btn btn-block btn-default">CANCELAR</a></div>

                <div class="col-md-2  float-sm-right"><button type="submit" class="btn btn-block btn-primary">SALVAR</button></div>
            </div>
        </form>
    </div>
</div>
<!-- /.card -->
@section('js')
    <script src="{{ asset('vendor/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.js') }}"></script>

    <script  type="text/javascript">

        $(document).ready(function() {

            $('#selectList').bootstrapDualListbox();

            $("#cep").mask("00000-000");
        });


        $("#cep").blur(function() {
            var cep = $(this).val().replace(/\D/g, '');
            if (cep != "") {
                var validacep = /^[0-9]{8}$/;
                if(validacep.test(cep)) {
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            console.log(dados);
                            $("#endereco").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $('#cidade').val(dados.localidade);
                            $('#estado').val(dados.uf);
                        }
                        else {
                            $('#cep').val('');
                            $.alert("CEP não encontrado.");
                        }
                    });
                }
                else {
                    $('#cep').val('');
                    $.alert("Formato de CEP inválido.");
                }
            }
        });

        $("#cnpj_cpf").keydown(function(){
            mascaraMutuario(this,cpfCnpj)
        });

        function mascaraMutuario(o,f){
            v_obj=o
            v_fun=f
            setTimeout('execmascara()',1)
        }

        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }

        function cpfCnpj(v){
            v=v.replace(/\D/g,"")

            if (v.length < 14) { //CPF
                v=v.replace(/(\d{3})(\d)/,"$1.$2")

                v=v.replace(/(\d{3})(\d)/,"$1.$2")
                v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

            } else { //CNPJ
                v=v.replace(/^(\d{2})(\d)/,"$1.$2")
                v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
                v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
                v=v.replace(/(\d{4})(\d)/,"$1-$2")
            }

            return v
        }

        $('#cnpj_cpf').blur(function(){
            var cpfcnpj = $(this).val();
            // debugger
            var tamanho = cpfcnpj.length;

            if (tamanho == 14 )
            {
                var cpf = cpfcnpj.replace('.','');
                cpf = cpf.replace('.','');
                cpf = cpf.replace('-','');
                cpf = validaCPF(cpf);

                if( cpf == false)
                {
                    $('.cpfcnpj').addClass('has-error has-danger');
                    $('.erro_cpfcnpj').html('CPF Invalido');
                    $(this).val('');
                }
                if(cpf != false) {
                    var cpf =  $('#cnpj_cpf').val();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'GET',
                        url: '/validacaoCPFCNPJ',
                        data: {
                            'documento' : cpfcnpj,
                        },
                        dataType: "JSON",
                        success: function(response){
                            if(response == 'documento existe') {
                                $('.erro_cpfcnpj').html('CPF ativo');
                                $('#cnpj_cpf').val('');
                            } else {
                                $('.erro_cpfcnpj').removeClass('has-error has-danger');
                                $('.erro_cpfcnpj').html('');
                            }
                            console.log(response);
                        },
                    });
                }
                else
                {
                    $('.cpfcnpj').removeClass('has-error has-danger');
                    $('.erro_cpfcnpj').html('');
                }
            }
            else
            {

                var  cnpj = valida_cnpj(cpfcnpj);
                if( cnpj == false)
                {
                    $('.statusacao').addClass('has-error has-danger');
                    $('.erro_cpfcnpj').html('CNPJ/CPF Inválido');
                    $(this).val('');
                }
                if(cnpj != false) {
                    var cnpj_cpf =  $('#cnpj_cpf').val();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'GET',
                        url: '/validacaoCPFCNPJ',
                        data: {
                            'documento' : cnpj_cpf,
                        },
                        dataType: "JSON",
                        success: function(response){

                            if(response == 'documento existe') {
                                $('.erro_cpfcnpj').html('CNPJ ativo');
                                $('#cnpj_cpf').val('');
                            } else {
                                $('.erro_cpfcnpj').removeClass('has-error has-danger');
                                $('.erro_cpfcnpj').html('');
                            }

                        },
                    });
                }

            }


        });

        $("#cnpj_cpf").keyup(function()
        {
            $('.cpfcnpj').removeClass('has-error has-danger');
            $('.erro_cpfcnpj').html('');
        });

       /* $('#telefone').keyup(function() {
            var telefone = $(this).val().replace(/\D/g, '').length;
            if(telefone > 10){
                $('#telefone').mask('(00) 00000-0000');
            }else{
                $('#telefone').mask('(00) 0000-00009');
            }
        });*/

    </script>
@stop
