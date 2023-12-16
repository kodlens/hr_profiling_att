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
    {{--    <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">


        <b-navbar>
            <template #brand>
                <b-navbar-item>
                    <h1 class="title is-5 has-text-weight-bold">{{ auth()->user()->lname }}</h1>
                </b-navbar-item>
            </template>

            <template #start>

            </template>

            <template #end>

                <b-navbar-item href="/employee/dashboard">
                    Home
                </b-navbar-item>

                <b-navbar-item href="/employee/personal-data-sheet">
                    Personal Data Sheet
                </b-navbar-item>


                <b-navbar-dropdown label="Training & Seminars">
                    <b-navbar-item href="/employee/training-seminars">
                        Training/Seminars
                    </b-navbar-item>
                    <b-navbar-item href="/employee/my-seminars">
                        My Seminars
                    </b-navbar-item>
                </b-navbar-dropdown>


            

                <b-navbar-dropdown label="{{ auth()->user()->lname }}">
                    <b-navbar-item href="/change-password">
                        Change Password
                    </b-navbar-item>
                </b-navbar-dropdown>

                <b-navbar-item tag="div">

                    <div class="buttons">
                        <button label="LOGOUT" 
                            class="button is-outlined is-danger"
                            onclick="document.getElementById('logout').submit()">
                            LOGOUT
                            &nbsp; &nbsp;
                            <b-icon icon="logout"></b-icon>
                        </button>
                    </div>
                </b-navbar-item>
            </template>
        </b-navbar>

        <form action="/logout" method="post" id="logout">@csrf</form>


        <div>
            @yield('content')
        </div>

        <!-- <footer-page></footer-page> -->
    </div>
</body>

</html>
