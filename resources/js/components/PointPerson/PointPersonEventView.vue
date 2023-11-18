<template>
    <div>

        <section class="section">
            <div class="columns is-centered">
                <div class="column is-7-widescreen is-10-desktop">
                    <div class="box">
                        <div class="mb-2">
                            <div class="has-text-weight-bold">EVENT NAME</div>
                            <div class="ml-2">
                                {{ propEventAttendees.event_title }}
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="has-text-weight-bold">EVENT DESCRIPTION</div>
                            <div class="ml-2" v-html="propEventAttendees.event_desc">
                                
                            </div>
                        </div>
                        <hr>
                        <div class="">
                            <div class="has-text-weight-bold">ATTENDEES</div>
                            <div class="ml-2">

                                <table class="table">
                                    <tr>
                                        <th>NAME</th>
                                        <th>ATTACHMENT</th>
                                    </tr>
                                    <tr v-for="(item,index) in propEventAttendees.attendees" :key="index">
                                        <td>{{ item.user.lname }}, {{ item.user.fname }} {{ item.user.mname }}</td>
                                        <td>
                                            <img :src="`/storage/attachments/${item.img_path}`" class="attachment-img" alt="attachment image"/>
                                        </td>
                                    </tr>
                                </table>
                               
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>
       

    </div>
</template>

<script>

export default{

    props: {
        propEventAttendees:{
            type: Object,
            default: {}
        }
    },


    data(){
        return {

        }
    },

    methods: {

    },

    mounted(){

    }
}
</script>

<style scoped>
    .attachment-img{
        height: 100px;
    }
</style>