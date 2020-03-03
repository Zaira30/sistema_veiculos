@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ORÇAMENTOS</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/budget">Orcamentos</a></li>
                        <li class="breadcrumb-item active">Editar Orcamento</li>
                    </ol>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        <a href="/budget" class="btn btn-block btn-outline-secondary btn-sm">VOLTAR</a>
                    </div>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

@stop

@section('content')

    <div class="container-fluid">
        {!! Form::model($budget, [
                'method' => 'PATCH',
        'url' => ['/budget', $budget->budget_id],
        'data-toggle' => 'validator',
        'class' => 'form',
        'files' => true
        ]) !!}

        @include ('budget::form', ['submitButtonText' => 'Salvar'])

        {!! Form::close() !!}

    </div>

@stop
