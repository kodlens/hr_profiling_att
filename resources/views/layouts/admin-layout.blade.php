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
  

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">

    @php
        $role = Auth::user()->role;
    @endphp

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

            <!-- ADMINISTRATOR ROLE -->
            @if($role == 'administrator')
                <b-navbar-item href="/dashboard" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                    <b-icon icon="home"></b-icon>
                    &nbsp;
                    HOME
                </b-navbar-item>

                <b-navbar-dropdown label="MANAGE" class="{{ request()->is('engagement-status*') ? 'active' : '' }}">
                    <b-navbar-item
                        href="/engagement-status">
                        Engagement Status
                    </b-navbar-item>
                    <b-navbar-item href="/institutes">
                        Institutes
                    </b-navbar-item>
                </b-navbar-dropdown>


                <b-navbar-item href="/events" class="{{ request()->is('events*') ? 'active' : '' }}">
                    <b-icon icon="calendar"></b-icon>
                    &nbsp;
                    EVENTS
                </b-navbar-item>

                <b-navbar-item href="/training-seminars" class="{{ request()->is('training-seminars*') ? 'active' : '' }}">
                    <b-icon icon="calendar"></b-icon>
                    &nbsp;
                    TRAININGS
                </b-navbar-item>
            
                <b-navbar-item href="/employees" class="{{ request()->is('admin/employees*') ? 'active' : '' }}">
                    <b-icon icon="account"></b-icon>
                    &nbsp;
                    EMPLOYEES
                </b-navbar-item>

                <b-navbar-item href="/users" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                    <b-icon icon="account"></b-icon>
                    &nbsp;
                    USER
                </b-navbar-item>

                
                <b-navbar-dropdown label="REPORTS" class="{{ request()->is('reports*') ? 'active' : '' }}">
                    <b-navbar-item
                        href="/report-by-sex">
                        Report By Sex
                    </b-navbar-item>
                    <b-navbar-item href="/report-by-educational-backgrounds">
                        Report Educational Background
                    </b-navbar-item>
                    <b-navbar-item href="/report-by-age-ranges">
                        Report Age Range
                    </b-navbar-item>
                    <b-navbar-item href="/report-by-engagement-status">
                        Report Engagement Status
                    </b-navbar-item>
                </b-navbar-dropdown>


            @endif

            <!-- TRAINING OFFICER ROLE -->
            @if($role == 'training_officer')
                <b-navbar-item href="/dashboard" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                    <b-icon icon="home"></b-icon>
                    &nbsp;
                    HOME
                </b-navbar-item>

                <b-navbar-dropdown label="EMPLOYEE" class="{{ request()->is('record-officer/employee/employee/*') ? 'active' : '' }}">
                    <b-navbar-item
                        href="/record-officer/employee">
                        Employee
                    </b-navbar-item>
                    <b-navbar-item href="#">
                        
                    </b-navbar-item>
                </b-navbar-dropdown>



                <b-navbar-item href="/training-seminars" class="{{ request()->is('training-seminars*') ? 'active' : '' }}">
                    <b-icon icon="calendar"></b-icon>
                    &nbsp;
                    TRAININGS
                </b-navbar-item>

                <b-navbar-item href="/qr-scanner" class="{{ request()->is('qr-scanner*') ? 'active' : '' }}">
                    <b-icon icon="qrcode"></b-icon>
                    &nbsp;
                    SCANNER
                </b-navbar-item>
   
            @endif


             <!-- POINT PERSON -->
             @if($role == 'point_person')
                <b-navbar-item href="/dashboard" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                    <b-icon icon="home"></b-icon>
                    &nbsp;
                    HOME
                </b-navbar-item>


                <b-navbar-item href="/events" class="{{ request()->is('events*') ? 'active' : '' }}">
                    <b-icon icon="calendar"></b-icon>
                    &nbsp;
                    EVENTS
                </b-navbar-item>



            @endif

            <!-- RECORD OFFICER -->
            @if($role == 'record_officer')
            <b-navbar-item href="/record-officer/dashboard" class="{{ request()->is('record-officer/dashboard') ? 'active' : '' }}">
                <b-icon icon="home"></b-icon>
                &nbsp;
                HOME
            </b-navbar-item>
            <b-navbar-dropdown label="EMPLOYEE" class="{{ request()->is('record-officer/employee/employee/*') ? 'active' : '' }}">
                <b-navbar-item
                    href="/record-officer/employee">
                    Employee
                </b-navbar-item>
                <b-navbar-item href="#">
                    
                </b-navbar-item>
            </b-navbar-dropdown>

            <b-navbar-dropdown label="REPORTS" class="{{ request()->is('reports*') ? 'active' : '' }}">
                <b-navbar-item
                    href="/report-by-sex">
                    Report By Sex
                </b-navbar-item>
                <b-navbar-item href="#">
                    Report Educational Background
                </b-navbar-item>
            </b-navbar-dropdown>

            @endif
            
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
