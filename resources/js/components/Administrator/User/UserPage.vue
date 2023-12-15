<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop is-10-tablet">

                    <div class="box">

                        <b-tabs v-model="activeTab">
                            <b-tab-item label="User list">
                                <user-main-list></user-main-list>
                            </b-tab-item>

                            <b-tab-item label="Archive user list">
                                <user-archive-list></user-archive-list>
                            </b-tab-item>
                        </b-tabs>

                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->


    </div>
</template>

<script>

export default{
    data() {
        return{
           activeTab: 0

        }

    },

    methods: {
        

    },

    mounted() {
    
    }

}
</script>


<style scoped>


</style>
