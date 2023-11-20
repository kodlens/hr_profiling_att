<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-6">

                    <div class="columns">
                        <div class="column">
                            <div class="buttons is-right">
                                <b-button
                                    tag="a"
                                    href="/training-officer/training-seminars/create"
                                    class="is-primary"
                                    icon-right="post" 
                                    label="NEW TRAINING/SEMINAR"></b-button>
                            </div>
                        </div>
                    </div>
                    
                   
                    <div class="box box-post" v-for="(seminar, index) in data.data" :key="index">
                        <div class="box-post-heading">
                            <div class="posted-text mb-4">Posted: {{ new Date(seminar.created_at).toLocaleString() }}</div>
                            <div class="post-action">

                            </div>
                        </div>
                        <div class="post-desc">
                           
                            <div class="columns">
                                <div class="column">
                                    <span class="has-text-weight-bold attr-name">TITLE: </span>
                                    <span>{{ seminar.seminar_title }}</span>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <span class="has-text-weight-bold">DESCRIPTION: </span>
                                    <span>{{ seminar.seminar_desc }}</span>
                                </div> <!--col--> 
                            </div> <!--cols-->

                            <div class="columns">
                                <div class="column">
                                    <span class="has-text-weight-bold">SEMINAR DATE: </span>
                                    <span>{{ new Date(seminar.seminar_date).toDateString()  }}</span>
                                </div>
                                
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <span class="has-text-weight-bold">SPONSORED BY: </span>
                                    <span>{{ seminar.sponsored_by  }}</span>
                                </div>
                                <div class="column">
                                    <span class="has-text-weight-bold">NO OF HOURS: </span>
                                    <span>{{ seminar.no_hours }}</span>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <span class="has-text-weight-bold">SPEAKER: </span>
                                    <span>{{ seminar.speaker  }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="post-img-container mt-3" v-if="seminar.attach_path">
                            <img :src="`/storage/training_seminars/${seminar.attach_path}`" class="post-img" />
                        </div>

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
          
            fields: {},

            data: [],
            total: 0,
            loading: false,
            sortField: 'training_seminar_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 10,
            defaultSortDirection: 'asc',

            search: {
                title: '',
            }
        }
    },

    methods: {
        loadSeminars(){

            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `title=${this.search.title}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')


            axios.get(`/training-officer/get-training-seminars?${params}`).then(res=>{
                console.log(res.data)
                this.data = res.data
            }).catch(err=>{

            })
        },


    },

    mounted(){
        this.loadSeminars()
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
