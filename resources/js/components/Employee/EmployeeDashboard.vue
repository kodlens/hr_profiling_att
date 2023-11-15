<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-6">
                    <div class="box box-post" v-for="(event, index) in events" :key="index">
                        <div class="box-post-heading">
                            <div class="posted-text mb-4">Posted: {{ event.created_at }}</div>
                            <div class="post-action">

                            </div>
                        </div>
                        <div class="post-desc">
                            <div class="columns">
                                <div class="column">
                                    <div class="has-text-weight-bold">Title: {{ event.event_title }}</div>
                                </div>
                            </div>
                            
                            <div class="columns">
                               
                                <div class="column">
                                    <div class="" v-html="event.content"> </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="post-img-container" v-if="event.img_path">
                            <img :src="`/storage/events/${event.img_path}`" class="post-img" />
                        </div>

                        <!-- <div class="box-post-footer">
                            <div class="buttons is-right">
                                <b-button label="Request Participation"
                                    @click="imIn(seminar)"
                                    type="is-primary"></b-button>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
export default{

    data(){
        return{
            events:[],
            fields: {},
        }
    },

    methods: {
        loadEvents(){
            axios.get('/employee-get-posted-events').then(res=>{
                this.events = res.data
            })
        },

        // imIn(post){
           
        //     this.fields = post;

        //     //console.log(postId);
        //     axios.post('/seminar-im-in', this.fields).then(res=>{
        //         if(res.data.status === 'saved'){
        //             this.$buefy.dialog.alert({
        //                 title: "Saved!",
        //                 message: 'Request recorded successfully.',
        //                 type: 'is-success',
        //                 onConfirm: ()=>  this.loadSeminars()
        //             });
        //         }
        //     }).catch(err=>{
            
        //     })
        // }
    },

    mounted(){
        this.loadEvents()
    }
}

</script>

<style scoped>
    .home-hero{
        height: 100vh;
    }

    .box-post-footer{
        padding: 25px;
    }
</style>
