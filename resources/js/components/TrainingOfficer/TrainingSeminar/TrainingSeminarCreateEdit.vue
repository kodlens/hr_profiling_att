<template>
    <div>

        <div class="columns is-centered mt-5">
            <div class="column is-6">
                <div class="box">
                    <div class="box-text mb-5">New Seminar / Trainings</div>

                    <div>
                        <div class="columns">
                            <div class="column">
                                <b-field label="Title" label-position="on-border"
                                    :type="this.errors.seminar_title ? 'is-danger':''"
                                    :message="this.errors.seminar_title ? this.errors.seminar_title[0] : ''">
                                    <b-input type="input" 
                                        placeholder="Title" 
                                        v-model="fields.seminar_title">
                                    </b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Description" label-position="on-border"
                                    :type="this.errors.seminar_desc ? 'is-danger':''"
                                    :message="this.errors.seminar_desc ? this.errors.seminar_desc[0] : ''">
                                    <b-input type="textarea" v-model="fields.seminar_desc" placeholder="Description">
                                    </b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Seminar Date" label-position="on-border"
                                    :type="this.errors.seminar_date ? 'is-danger':''"
                                    :message="this.errors.seminar_date ? this.errors.seminar_date[0] : ''">
                                    <b-datepicker placeholder="Seminar Date" :min-date="minDate" v-model="fields.seminar_date">
                                    </b-datepicker>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="No. of hours" label-position="on-border"
                                    :type="this.errors.no_hours ? 'is-danger':''"
                                    :message="this.errors.no_hours ? this.errors.no_hours[0] : ''">
                                    <b-numberinput type="number" placeholder="No. of hours"
                                        :controls="false"
                                        v-model="fields.no_hours">
                                    </b-numberinput>
                                </b-field>
                            </div>
                        </div>
                       
                        <div class="columns">
                            <div class="column">
                                <b-field label="Conducted/Sponsored By" label-position="on-border"
                                    :type="this.errors.sponsored_by ? 'is-danger':''"
                                    :message="this.errors.sponsored_by ? this.errors.sponsored_by[0] : ''">
                                    <b-input type="input" placeholder="Conducted/Sponsored By"
                                        v-model="fields.sponsored_by">
                                    </b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Speaker" label-position="on-border">
                                    <b-input type="input"
                                        placeholder="Speaker" v-model="fields.speaker">
                                    </b-input>
                                </b-field>
                            </div> <!--col--> 
                        </div> <!--cols-->


                     

                      

                        <b-field class="file is-primary" :class="{'has-name': !!file}"
                            :type="this.errors.file ? 'is-danger':''"
                            :message="this.errors.file ? this.errors.file[0] : ''">
                            <b-upload v-model="file" class="file-label">
                                <span class="file-cta">
                                    <b-icon class="file-icon" icon="upload"></b-icon>
                                    <span class="file-label">Click to upload</span>
                                </span>
                                <span class="file-name" v-if="file">
                                    {{ file.name }}
                                </span>
                            </b-upload>
                        </b-field>

                        <div class="buttons is-right">
                            <b-button type="is-primary is-outlined" label="Post Training" @click="submit"></b-button>
                        </div>

                    </div>
                </div>




            </div> <!-- col -->
        </div>
    </div>
</template>

<script>

export default{
    data(){
        return {
            file: null,
            desc: '',

            fields: {},
            errors: {},

            seminar_id: 0,

            seminars: [],
            specializations: [],
            ld_types: [],

            minDate: new Date()
        }
    },

    methods: {

        initData(){

        },

        clear(){
            this.fil = null;
            this.desc = '';
        },


        loadLearningDevelopmentTypes(){
            axios.get('/get-open-learning-dev-types').then(res=>{
                this.ld_types = res.data
                console.log(this.ld_types);
            })
        },
        loadSpecializations(){
            axios.get('/get-open-specializations').then(res=>{
                this.specializations = res.data
            })
        },


        submit(){
            let ndate = new Date(this.fields.seminar_date);
            let newDate = ndate.getFullYear() + '-' + (ndate.getMonth() + 1) + '-' + ndate.getDate();

            let formData = new FormData();
            formData.append('seminar_title', this.fields.seminar_title ? this.fields.seminar_title : '');
            formData.append('seminar_date', newDate);
            formData.append('seminar_desc', this.fields.seminar_desc ? this.fields.seminar_desc : '');
            formData.append('sponsored_by', this.fields.sponsored_by ? this.fields.sponsored_by : '');
            formData.append('no_hours', this.fields.no_hours ? this.fields.no_hours: '');
            formData.append('speaker', this.fields.speaker ? this.fields.speaker: '');
            formData.append('file', this.file);

            if(this.seminar_id > 0){
                axios.post('/training-officer/training-seminars-update/' + this.seminar_id, formData).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: "Updated!",
                            message: 'Seminar post successfully update.',
                            type: 'is-success',
                            onConfirm: ()=>  {
                                //this.loadSeminars()
                                this.clearFields()

                            }
                        });
                    }
                }).catch(err=>{
                    if(err.response.status == 422){

                        this.errors = err.response.data.errors
                    }
                })
            }else{
                axios.post('/training-officer/training-seminars', formData).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: "Posted!",
                            message: 'Seminar successfully posted.',
                            type: 'is-success',
                            onConfirm: ()=>  {
                                //this.loadSeminars()
                                window.location = '/training-officer/training-seminars'
                                this.clearFields()
                            }
                        });
                    }
                }).catch(err=>{
                    if(err.response.status == 422)
                        this.errors = err.response.data.errors
                })
            }

        },

        clearFields(){
            this.fields = {}
            this.file = null
        },



        // updatePost(seminarPostId){
        //     this.seminar_id = seminarPostId
        //     this.fields = {};
        //
        //     axios.get('/hrld/get-seminar-posts/' + seminarPostId).then(res=>{
        //         this.fields = {
        //             title: res.data.title,
        //             skills: res.data.skills,
        //             seminar_date: new Date(res.data.seminar_date),
        //             ld_type: res.data.ld_type,
        //             conducted_by: res.data.conducted_by,
        //             cpd_units: res.data.cpd_units,
        //             no_hours: parseInt(res.data.no_hours),
        //             specialization: res.data.specialization,
        //             description: res.data.description
        //         }
        //     })
        // }
    },

    mounted(){
        //this.loadSeminars()
        //this.loadLearningDevelopmentTypes()
        //this.loadSpecializations()
    }
}
</script>

<style scoped>
    .box-post{
        margin: 10px 0;
        border-top: 0px;

    }

    .post-img-container{
        height: 300px;
        overflow: hidden;
        display: flex;
        justify-content: center;
    }
    .posted-text{
        font-weight: bold;
        font-style: .8em;
        color: gray;
    }
    .post-img{
        height: 400px;
    }

    .box-post-heading{
        display: flex;
        padding: 10px;
    }
    .post-action{
        margin-left: auto;
    }

    .post-desc{
        border-top: 1px solid gray;
        margin: 10px;
        padding: 10px 0
    }
</style>
