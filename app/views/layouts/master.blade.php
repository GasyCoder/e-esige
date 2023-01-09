<?php 
$path = Session::get('language');
$control = Control::find(1);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Generics -->
    <link rel="icon" href="assets/images/favicon/favicon-32.png" sizes="32x32">
    <link rel="icon" href="assets/images/favicon/favicon-128.png" sizes="128x128">
    <link rel="icon" href="assets/images/favicon/favicon-192.png" sizes="192x192">
    <!-- Android -->
    <link rel="shortcut icon" href="assets/images/favicon/favicon-196.png" sizes="196x196">
    <!-- iOS -->
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon-152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon-167.png" sizes="167x167">
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon-180.png" sizes="180x180">
    {{HTML::style('public/assets/css/style.css')}}
    {{ HTML::style('public/assets/css/datatable.css') }}
    
    {{ HTML::style('public/assets/js/Manage/vendor/select2/dist/css/select2.min.css') }}
    {{ HTML::style('public/assets/js/Manage/css/argon.css?v=1.2.0') }}

    {{ HTML::script('public/assets/js/other/jquery-3.6.0.js') }}
    {{ HTML::script('public/assets/js/other/jquery-ui.js') }}

    @yield('css')
</head>
<body>

@if(Auth::user()->is_admin)
@if(!Auth::user()->is_secretaire) 
    @include('components.pages.header')
    @include('components.pages.menubar')
    @include('components.pages.customize')
@endif
@endif

@if(Auth::user()->is_student) 
    @include('components.stds.header')
    @include('components.stds.menubar')
@endif

    @yield('content')


    <!-- Scripts -->
    <script src="{{url()}}/public/assets/js/vendor.js"></script>
    <script src="{{url()}}/public/assets/js/chart.min.js"></script>
    <script src="{{url()}}/public/assets/js/script.js"></script>
    
    <!--DATATABLE -->
    <script src="{{ url() }}/public/assets/script/datatable.js"></script><!--sort table class-->
    <script src="{{ url() }}/public/assets/script/demo.js"></script><!--function table-->

    <script src="{{ url() }}/public/assets/js/Manage/vendor/select2/dist/js/select2.min.js"></script>
    <script src="{{ url() }}/public/assets/js/Manage/js/argon.js?v=1.2.0"></script>
    @yield('js')
</body>
</html>