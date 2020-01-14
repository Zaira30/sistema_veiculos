@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Marcas</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Marcas</a></li>
                        <li class="breadcrumb-item active">Criar Novo</li>
                    </ol>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        <a href="/marcas" class="btn btn-block btn-outline-secondary btn-sm">VOLTAR</a>
                    </div>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@stop

@section('content')

    <div class="container-fluid">
        {!! Form::open(['url' => '/marcas/create',  'data-toggle' => 'validator', 'files' => true, 'class' => 'form']) !!}
            @include ('marcas.form')
        {!! Form::close() !!}

    </div>

@stop