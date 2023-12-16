<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-6">
                    <div class="box box-post" v-for="(seminar, index) in data.data" :key="index">
                        <div class="box-post-heading">
                            <div class="posted-text mb-4">Posted: {{ new Date(seminar.created_at).toLocaleString() }}</div>
                            <div class="post-action">

                            </div>
                        </div>
                        <div class="post-desc">
                            <div class="columns">
                                <div class="column">
                                    <div class="seminar-label">TITLE: </div>
                                    <div>
                                        {{ seminar.seminar_title }}
                                    </div>
                                </div>
                                
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="seminar-label">SEMINAR DATE: </div>
                                    <div>
                                        {{ new Date(seminar.date_from).toLocaleString()  }} - {{ new Date(seminar.date_to).toLocaleString() }} 
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="seminar-label">SPONSORED BY:</div>
                                    <div>
                                        {{ seminar.sponsored_by  }}
                                    </div>
                                </div>

                                <div class="column">
                                    <div class="seminar-label"></div> 
                                    
                                    <div>
                                        {{ seminar.no_hours }}
                                    </div>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <div class="seminar-label">SPEAKER: </div>
                                    <div>
                                        {{ seminar.speaker  }}
                                    </div>
                                </div>
                              
                            </div>

                            <hr>
                          
                        </div>
                        
                        <div class="post-img-container" v-if="seminar.attach_path">
                            <img :src="`/storage/trainings/${seminar.attach_path}`" class="post-img" />
                        </div>


                        <div class="buttons mt-4">
                            <b-button label="Participate" @click="participateMe(seminar)" type="is-primary"></b-button>
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


            axios.get(`/employee/get-training-seminars?${params}`).then(res=>{
                console.log(res.data)
                this.data = res.data
            }).catch(err=>{

            })
        },


        participateMe(row){
            axios.post('/employee/participate-me', row).then(res=>{

                if(res.data.status === 'participated'){
                    this.$buefy.toast.open({
                        message: 'Successfully registered.',
                        type: 'is-success'
                    })
                }
            }).catch(err => {
                if(err.response.status === 422){
                    let errors = err.response.data.errors
                    
                    this.$buefy.dialog.alert({
                        title: 'EXIST!',
                        message: errors.exist[0],
                        type: 'is-danger',
                     
                    })
                }
            })
        }

    },

    mounted(){
        this.loadSeminars()
    }
}

</script>

<style scoped>
    .seminar-label{
        font-weight: bold;
        color: gray;
    }
</style>
