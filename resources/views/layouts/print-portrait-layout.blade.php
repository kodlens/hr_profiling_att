<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        @media print {

            html, body{
                margin: 0;
                background-color: white;
            }
            .print-form{
                margin: 0;
                width: 100%;
            }

            .nprint{
                display: none;
            }

            header,
            footer,
            aside,
            nav,
            form,
            iframe, .menu, .hero, .adslot {
                display: none;
            }

            .buttons{
                display: none;
            }



        }

        @page {
            size:  8.5in 13in;
        }

    </style>

</head>
<body>
<div id="app">
{{--    <navbar-component></navbar-component>--}}
    <div>
        @yield('content')
    </div>


</div>
</body>
</html>
