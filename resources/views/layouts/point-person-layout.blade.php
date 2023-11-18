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
</head>
<body>
<div id="app">

    <b-navbar>
            <template #brand>
                <b-navbar-item>
                    <img
                        src="/img/logo.png"
                        alt="Tangub City Logo"
                    >
                </b-navbar-item>
            </template>
            <template #start>
                
            </template>

            <template #end>

                <b-navbar-item href="/point-person/dashboard" class="{{ request()->is('point-person-home*') ? 'active' : '' }}">
                    <b-icon icon="home"></b-icon>
                    &nbsp;
                    HOME
                </b-navbar-item>

                <b-dropdown
                    append-to-body
                    aria-role="menu"
                    scrollable
                    max-height="200"
                    trap-focus
                >
                    <template #trigger>
                        <a
                            class="navbar-item"
                            role="button">
                            <b-icon icon="cog"></b-icon> &nbsp;
                            <span>SETTING</span>
                            <b-icon icon="menu-down"></b-icon>
                        </a>
                    </template>

                    <b-dropdown-item custom aria-role="listitem">
                        <b-input placeholder="search" expanded />
                  </b-dropdown-item>
                  

                </b-dropdown>

                <b-navbar-item href="/point-person/events" class="{{ request()->is('point-person/events*') ? 'active' : '' }}">
                    <b-icon icon="calendar"></b-icon>
                    &nbsp;
                    EVENTS
                </b-navbar-item>

                
                <b-navbar-item tag="div">
                    <div class="buttons">

                        <button class="button is-danger is-outlined" 
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

</div>
</body>
</html>
