<template>
    <div>
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

                <b-navbar-item href="/admin-home">
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


                <b-navbar-item href="/users">
                    <b-icon icon="account"></b-icon>
                    &nbsp;
                    USER
                </b-navbar-item>
                <b-navbar-item tag="div">
                    <div class="buttons">

                        <a class="button is-danger is-outlined" @click="logout">
                            LOGOUT
                            &nbsp; &nbsp;
                            <b-icon icon="logout"></b-icon>
                        </a>
                    </div>
                </b-navbar-item>
            </template>
        </b-navbar>

    </div>


</template>

<script>
export default {
    data(){
        return{

        }
    },
    methods: {
        logout(){
            axios.post('/logout').then(()=>{
                window.location = '/';
            })
        },

        loadUser(){
            axios.get('/load-user').then(res=>{
                this.user = res.data;
            })
        }
    },

    mounted(){
        this.loadUser();
    },

    computed: {
        userRole(){
            return this.user.role.toUpperCase();
        }
    }
}
</script>

<style scoped>


    .logo{
        padding: 0 30px 0 30px;
        height: 90px;
    }

    .burger-div{
        width: 20px;
        height: 3px;
        background-color: #696969;
        margin: 0 0 3px 0;
        margin-left: auto;
        border-radius: 10px;
    }

    .burger-button{
        display: flex;
        flex-direction: column;
        margin-left: auto;
    }

    .mynav{
        padding: 25px;
        border-bottom: 2px solid rgba(196, 196, 196, 0.53);
        display: flex;
    }

    .mynav-brand{
        font-weight: bold;
        font-size: 1.2em;
    }

  /* .hero{
        background-image: url("/img/bg-hero.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    } */


</style>
