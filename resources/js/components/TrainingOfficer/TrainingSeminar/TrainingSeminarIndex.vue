<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-6">
                    <div class="box box-post" v-for="(seminar, index) in data.data" :key="index">
                        <div class="box-post-heading">
                            <div class="posted-text mb-4">Posted: {{ seminar.created_at }}</div>
                            <div class="post-action">

                            </div>
                        </div>
                        <div class="post-desc">
                            <div class="columns">
                                <div class="column">
                                    <div class="has-text-weight-bold">Title: {{ seminar.seminar_title }}</div>
                                </div>
                                
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="has-text-weight-bold">Serminar Date: {{ seminar.date_from  }}</div>
                                </div>
                                <div class="column">
                                    <div class="has-text-weight-bold">Learning Development: {{ seminar.ld_type }}</div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="has-text-weight-bold">Sponsored By: {{ seminar.sponsored_by  }}</div>
                                </div>
                                <div class="column">
                                    <div class="has-text-weight-bold">No of Hours: {{ seminar.no_hours }}</div>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <div class="has-text-weight-bold">Speaker: {{ seminar.speaker  }}</div>
                                </div>
                              
                            </div>
                          
                        </div>
                        
                        <div class="post-img-container" v-if="seminar.attach_path">
                            <img :src="`/storage/seminars/${seminar.attach_path}`" class="post-img" />
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
