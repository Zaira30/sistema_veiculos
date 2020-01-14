@extends('adminlte::master')

@section('adminlte_css')
    @yield('css')
@stop

@section('classes_body', 'login-page')

@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="login-box">
        <div class="login-logo">
            {{--alterar para o nome do projeto--}}
           {{-- <a href="{{ $dashboard_url }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>--}}
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Cadastro de Senha</p>
                <form action="{{ $password_reset_url }}" method="post" class="formLogin">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" id="token" value="{{ $token }}">
                    <div class="input-group mb-3">

                            <div class="input-group mb-3">
                                <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ trans('adminlte::adminlte.password') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password_confirmation" id="confirmpassword" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                               placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <button id="clickme" type="submit" class="btn btn-primary btn-block btn-flat">
                                                Enviar
                                            </button>
                                    </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script>
        $(function(){
            $(".formLogin").submit(function(e){

                if($('#password').val() != '' && $('#confirmpassword').val() != ''){
                    if($('#password').val() == $('#confirmpassword').val()) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : '/novasenha',
                            type: "GET",
                            data:{
                                password: $('#password').val(),
                                token: $('#token').val()
                            },
                            dataType: 'json',
                            success:function(result){
                                var listRemove = ['#clickme'];
                                listRemove.map(function (field) {
                                    $(field).remove();
                                });

                                var listHidden = ['#password', '#confirmpassword'];
                                listHidden.map(function (field) {
                                    $(field).attr("disabled", "disabled");
                                })

                                if(result.status == true){
                                    $.alert('Senha alterada com sucesso!');
                                    /*window.location.href = "/logout";*/

                                } else{
                                    $.alert('Não foi possível alterar a senha!');
                                }
                            },
                        });
                    } else {
                        $.alert('Senhas não coincidem!');
                    }
                }
                e.preventDefault();
            });
        });
    </script>
    @yield('js')

   {{-- <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')--}}
@stop
