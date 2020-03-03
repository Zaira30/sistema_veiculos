<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MYPHARMA 2GO</title>
    @if(! config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @include('adminlte::plugins', ['type' => 'css'])

    @yield('adminlte_css_pre')

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

{{--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}

    <link  href="{{ asset('/vendor/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @yield('adminlte_css')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif

<!-- Modal Alert -->
    <link rel="stylesheet" href="{{ asset("/vendor/alert-modal/jquery-confirm.min.css")}}">
    <link rel="stylesheet" href="{{ asset("/vendor/jquery-image/src/image-uploader.css")}}">

    <link  href="{{ asset('vendor/bootstrap4-duallistbox/bootstrap-duallistbox.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("/vendor/summernote/summernote-lite.css")}}">


    <!-- Personalizado -->
    <link rel="stylesheet" href="{{ asset('css/mainstyle.css') }}">

    <style>
        .ui-datepicker {
            width: 19em;
            padding: .2em .2em 0;
        }

        .img-bloco {
            background-image: none;
            border: 1px solid #3b9182 !important;
            border-radius: 3px !important;
        }


        #image-preview {
            width:300px;
            height: 300px;
            position: relative;
            overflow: hidden;
            background-color: #0000;
            color: #ecf0f1;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            margin-left: 15px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            z-index: 1000;

        }

        /*     #image-preview {
                 width: 400px;
                 height: 400px;
                 position: relative;
                 overflow: hidden;
                 background-color: #ffffff;
                 color: #ecf0f1;
             }*/
        #image-preview input {
            line-height: 200px;
            font-size: 200px;
            position: absolute;
            opacity: 0;
            z-index: 10;
        }
        #image-preview label {
            position: absolute;
            z-index: 5;
            opacity: 0.8;
            cursor: pointer;
            background-color: #bdc3c7;
            width: 200px;
            height: 50px;
            font-size: 14px;
            line-height: 50px;
            text-transform: uppercase;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            text-align: center;
        }

    </style>

</head>
<body class="@yield('classes_body')" @yield('body_data')>

@yield('body')

@if(! config('adminlte.enabled_laravel_mix'))
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('vendor/jQuery-Mask-Plugin/dist/jquery.mask.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
{{--<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>--}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script src="{{ asset('js/custom.js') }}"></script>

<script src="{{ asset ("vendor/alert-modal/jquery-confirm.min.js") }}" type="text/javascript"></script>

@include('adminlte::plugins', ['type' => 'js'])

@yield('adminlte_js')
@else
<script src="{{ asset('js/app.js') }}"></script>
@endif


</body>
</html>
