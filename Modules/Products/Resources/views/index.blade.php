@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">PRODUTOS</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Produtos</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">

                        {{--@if(Auth::user()->can('create-perfil'))--}}
                        <a href="/products/create" class="btn btn-block btn-mypharma">CRIAR NOVO</a>
                        {{-- @endif--}}
                    </div>
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
                    <h3 class="card-title">Produtos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                                <thead>
                                <th width="33%">Produto</th>
                                <th width="33%">Loja</th>
                                <th>Variação</th>
                                <th>Status</th>
                                <th width="80px">Ações</th>
                                </thead>
                            </table>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop
@section('js')

    <script>
        $(document).ready(function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var datatable = $('#datatable-table').DataTable({
                processing: false,
                serverSide: true,
                responsive: true,
                "pageLength": 100,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'print'
                ],
                "ajax": {
                    url: '{!! route('products.data') !!}',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    dataType: 'JSON',
                    type: 'GET',
                    data: {_token: CSRF_TOKEN},
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization');
                    },
                    data: function (d) {
                        d.pesquisar = $('.JpesquisarDataTable').val();
                    },
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'store.name', name: 'store.name' },
                    { data: 'variation', name: 'variation' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' }
                ],
                "language": { "url": "/vendor/datatables/lang/pt-BR.json" }
                //  ,order: [ [1, 'asc'] ]


            });

        });


    </script>

@stop
