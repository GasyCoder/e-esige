<?php /*$control = Setting::find(1);*/?>
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
    @yield('css')
</head>
<body>
    <main class="workspace">
        
        
        @yield('content')
        
        <!-- Footer -->
        <footer class="mt-auto">
            <div class="footer">
                <span class="">Created by <a href="https://gasycoder.com/" target="_blank">Gasy Coder</a> with ❤️</span>
                <nav>
                    <a href="#">FAQ</a>
                    <span class="divider">|</span>
                    <a href="mailto:GasyCoder<hello@gasycoder.com>?subject=Contact-App-E-ESIGE" target="_blank" rel="noreferrer">Contact</a>
                </nav>
            </div>
        </footer>

    </main>
    <!-- Scripts -->
    <script src="{{url()}}/public/assets/js/vendor.js"></script>
    <script src="{{url()}}/public/assets/js/chart.min.js"></script>
    <script src="{{url()}}/public/assets/js/script.js"></script>
    @yield('js')
</body>
</html>