
    <!-- Be present above all else. - Naval Ravikant -->

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

            <b-navbar-item href="/admin/dashboard" class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                <b-icon icon="home"></b-icon>
                &nbsp;
                HOME
            </b-navbar-item>

            <b-navbar-dropdown label="MANAGE" class="{{ request()->is('admin/engagement-status*') ? 'active' : '' }}">
                <b-navbar-item 
                    href="/admin/engagement-status">
                    Engagement Status
                </b-navbar-item>
                <b-navbar-item href="#">
                    Contact
                </b-navbar-item>
            </b-navbar-dropdown>


            <b-navbar-item href="/admin/events" class="{{ request()->is('admin/events*') ? 'active' : '' }}">
                <b-icon icon="calendar"></b-icon>
                &nbsp;
                EVENTS
            </b-navbar-item>

            <b-navbar-item href="/admin/training-seminars" class="{{ request()->is('admin/training-seminars*') ? 'active' : '' }}">
                <b-icon icon="calendar"></b-icon>
                &nbsp;
                TRAININGS
            </b-navbar-item>


            <b-navbar-item href="/admin/users" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <b-icon icon="account"></b-icon>
                &nbsp;
                USER
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
