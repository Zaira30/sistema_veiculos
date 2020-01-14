@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Perfis</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Perfis</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">

                        {{--@if(Auth::user()->can('create-perfil'))--}}
                            <a href="/perfis/create" class="btn btn-block btn-primary">CRIAR NOVO</a>
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
                    <h3 class="card-title">PERFIS</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-striped table-bordered table-hover" width="100%" id="datatable-table">
                                <thead>
                                <th>Perfil</th>
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
                    url: '{!! route('perfis.data') !!}',
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
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' }
                ],
                "language": { "url": "/vendor/datatables/lang/pt-BR.json" }
                //  ,order: [ [1, 'asc'] ]
                ,'drawCallback' : function( settings ) {
                    if($(".JpesquisarDataTable").length<=0)
                    {
                        $(".dataTables_filter").html("");
                        $(".dataTables_filter").html("<label>Pesquisar<input class=\"form-control JpesquisarDataTable input-sm\" placeholder=\"\"  type=\"text\"></label>");

                        $(".JpesquisarDataTable").keyup(function(x){
                            if( $(".JpesquisarDataTable").val().length>=3 || $(".JpesquisarDataTable").val().length<=0)
                            {
                                datatable.draw();
                            }
                        })
                    }
                }

            });

        });


    </script>

@stop
