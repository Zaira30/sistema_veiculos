@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/>
    <style>
        select {
            font-family: 'FontAwesome', 'Second Font name'
        }

    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Menus</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/menus">Menus</a></li>
                        <li class="breadcrumb-item active">Criar Novo</li>
                    </ol>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        <a href="/perfis" class="btn btn-block btn-outline-secondary btn-sm">VOLTAR</a>
                    </div>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@stop

@section('content')

    <div class="container-fluid">
        {!! Form::open(['url' => '/menus/create',  'data-toggle' => 'validator', 'files' => true, 'class' => 'form']) !!}
        @include ('menus.form')
        {!! Form::close() !!}

    </div>

@stop
