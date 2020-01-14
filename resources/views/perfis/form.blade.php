<!-- general form elements -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">PERFIL</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('display_name') ? 'has-error' : ''}}">
                            {!! Form::label('display_name', 'Perfi *', ['class' => 'control-label']) !!}
                            {!! Form::text('display_name', null,  ['class' => 'form-control',  'maxlength'=>150, 'required' => 'required']) !!}
                            {!! $errors->first('display_name', '<p class="help-block">:message</p>') !!}
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
                        <h6 style="color:#027afd">LISTA DE USUÁRIOS</h6>
                    </div>
                    <div class="col-md-6">
                        <h6 style="color:#027afd">LISTA DE USUÁRIOS SELECIONADOS</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box1 col-md-12">
                            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                                {!! Form::select('user_id[]', $usuarios, $usuariosSelect,  ['class' => 'form-control', 'required' => 'required', 'id' => 'selectList', 'multiple' => 'multiple' ]) !!}
                                {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 50px">

                    <div class="col-md-12">
                        <h4 style="color:#027afd"v>MENUS</h4>

                        <div class="col-md-12">
                            <table width="100%" >
                                <thead>
                                        <th width="60%">&ensp;</th>
                                        <th style="text-align: center">Criar</th>
                                        <th style="text-align: center" >Visualizar</th>
                                        <th style="text-align: center">Alterar</th>
                                        <th style="text-align: center">Excluir</th>
                                </thead>

                                <tbody>
                                @foreach($menus as $value)
                                        <tr>
                                            <td><label>{{$value['name']}}</label></td>
                                            <?php
                                            $l = 1;
                                            ?>
                                            @foreach($value['permissoes'] as $permissao)
                                                <td style="text-align: center">
                                                    <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input"  name="permissao[]"  @if(in_array($permissao['id'], $permissoes)) checked @endif value="{{$permissao['id']}}" id="customSwitchw{{$l}}">
                                                        <label class="custom-control-label" for="customSwitchw{{$l}}"></label>
                                                    </div>
                                                </td>

                                                <?php
                                                $l += 1;
                                                ?>
                                            @endforeach

                                        </tr>

                                        @if(isset($value['submenu']))

                                            <?php
                                                $j = 1;
                                            ?>
                                            @foreach($value['submenu'] as $sub)
                                                <tr>
                                                    <td><div style="margin-left: 26px">{{$sub['text']}}</div></td>
                                                    @foreach( $sub['permissoes'] as $key => $permissao)
                                                        <td style="text-align: center">
                                                            <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-success">
                                                                <input type="checkbox" class="custom-control-input"  name="permissao[]" @if(in_array($permissao['id'], $permissoes)) checked @endif  value="{{$permissao['id']}}" id="customSwitch{{$j}}">
                                                                <label class="custom-control-label" for="customSwitch{{$j}}"></label>
                                                            </div>

                                                        </td>
                                                        <?php
                                                        $j += 1;
                                                        ?>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endif
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <div class="col-md-2  float-sm-left"><a href="/perfis" class="btn btn-block btn-default">CANCELAR</a></div>

                {{--@if(Auth::user()->can('create-perfil') || Auth::user()->can('edit-perfil'))--}}
                    <div class="col-md-2  float-sm-right"><button type="submit" class="btn btn-block btn-primary">SALVAR</button></div>
              {{--  @endif--}}
            </div>
        </form>
    </div>
</div>
<!-- /.card -->
@section('js')

    <script src="{{ asset('vendor/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.js') }}"></script>

    <script  type="text/javascript">

        $(document).ready(function() {
            $('select[name="user_id[]"]').bootstrapDualListbox();

        });

        $('#telefone').keyup(function() {
            var telefone = $(this).val().replace(/\D/g, '').length;
            if(telefone > 10){
                $('#telefone').mask('(00) 00000-0000');
            }else{
                $('#telefone').mask('(00) 0000-00009');
            }
        });



    </script>
@stop
