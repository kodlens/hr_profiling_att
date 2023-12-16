<template>
    <div>

        <div class="columns is-centered mt-5">
            <div class="column is-6">
                <div class="box">
                    <div class="box-text mb-5 has-text-weight-bold">New Seminar / Trainings</div>

                    <div>
                        <div class="columns">
                            <div class="column">
                                <b-field label="Title" label-position="on-border"
                                    :type="errors.seminar_title ? 'is-danger':''"
                                    :message="errors.seminar_title ? errors.seminar_title[0] : ''">
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
                                    :type="errors.seminar_desc ? 'is-danger':''"
                                    :message="errors.seminar_desc ? errors.seminar_desc[0] : ''">
                                    <b-input type="textarea" v-model="fields.seminar_desc" placeholder="Description">
                                    </b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Seminar Date From" label-position="on-border"
                                    :type="errors.date_from ? 'is-danger':''"
                                    :message="errors.date_from ? errors.date_from[0] : ''">
                                    <b-datetimepicker placeholder="Seminar Date" :min-date="minDate"
                                        v-model="fields.date_from">
                                    </b-datetimepicker>
                                </b-field>
                            </div>

                            <div class="column">
                                <b-field label="Seminar Date To" label-position="on-border"
                                 :type="errors.date_to ? 'is-danger':''"
                                 :message="errors.date_to ? errors.date_to[0] : ''">
                                    <b-datetimepicker placeholder="Seminar Date"
                                        :min-date="minDate"
                                        @input="durationHours"
                                        v-model="fields.date_to">
                                    </b-datetimepicker>
                                </b-field>
                            </div>
                            <div class="column is-3">
                                <b-field label="No. of hours" label-position="on-border"
                                    :type="errors.no_hours ? 'is-danger':''"
                                    :message="errors.no_hours ? errors.no_hours[0] : ''">
                                    <b-input type="text" placeholder="No. of hours"
                                        disabled
                                        v-model="fields.no_hours">
                                    </b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Conducted/Sponsored By" label-position="on-border"
                                    :type="errors.sponsored_by ? 'is-danger':''"
                                    :message="errors.sponsored_by ? errors.sponsored_by[0] : ''">
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

                        <p v-if="propId > 0" style="font-size: 10px; font-weight: bold; color: red;">To update the file, just attach new file and the system will automatically remove the old file.</p>
                        <div class="columns">
                            <div class="column">
                                <b-field class="file is-primary" :class="{'has-name': !!file}"
                                    :type="this.errors.file ? 'is-danger':''"
                                    :message="this.errors.file ? this.errors.file[0] : ''">
                                    <b-upload v-model="fields.file" class="file-label">
                                        <span class="file-cta">
                                            <b-icon class="file-icon" icon="upload"></b-icon>
                                            <span class="file-label">Click to upload</span>
                                        </span>
                                        <span class="file-name" v-if="fields.file">
                                            {{ fields.file.name }}
                                        </span>
                                    </b-upload>
                                </b-field>
                            </div>
                        </div>
                        

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

    props: {
        propId: {
            type: Number,
            default: 0
        },
        propData: {
            type: Object,
            default: {}
        }
    },


    data(){
        return {
            file: null,
            desc: '',

            fields: {

                date_from: new Date(),
                date_to: new Date(),
                no_hours: null
            },
            errors: {},


            minDate: new Date(),


        }
    },

    methods: {


        clear(){
            this.fil = null;
            this.desc = '';
        },


        durationHours(){
            let timeDifference =  new Date(this.fields.date_to) - new Date(this.fields.date_from);
            // Convert milliseconds to hours
            let hoursDifference = timeDifference / (1000 * 60 * 60);
            let result = parseFloat(hoursDifference.toFixed(2))
            this.fields.no_hours = result
        },



        submit(){

            const dateFrom = this.$formatDateAndTime(new Date(this.fields.date_from));
            const dateTo = this.$formatDateAndTime(new Date(this.fields.date_to));

            let formData = new FormData();
            formData.append('seminar_title', this.fields.seminar_title ? this.fields.seminar_title : '');
            formData.append('date_from', this.fields.date_from ? dateFrom : '');
            formData.append('date_to', this.fields.date_to ? dateTo : '');
            formData.append('seminar_desc', this.fields.seminar_desc ? this.fields.seminar_desc : '');
            formData.append('sponsored_by', this.fields.sponsored_by ? this.fields.sponsored_by : '');
            formData.append('no_hours', this.fields.no_hours ? this.fields.no_hours: '');
            formData.append('speaker', this.fields.speaker ? this.fields.speaker: '');
            formData.append('file', this.fields.file ? this.fields.file : '');

            if(this.propId > 0){
                axios.post('/training-seminars-update/' + this.propId, formData).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: "Updated!",
                            message: 'Seminar post successfully update.',
                            type: 'is-success',
                            onConfirm: ()=>  {
                                //this.loadSeminars()
                                window.location = '/training-seminars'
                            }
                        });
                    }
                }).catch(err=>{
                    if(err.response.status == 422){

                        this.errors = err.response.data.errors
                    }
                })
            }else{

                axios.post('/training-seminars', formData).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: "Posted!",
                            message: 'Seminar successfully posted.',
                            type: 'is-success',
                            onConfirm: ()=>  {
                                //this.loadSeminars()
                                window.location = '/training-seminars'
                            }
                        });
                    }
                }).catch(err=>{
                    if(err.response.status == 422)
                        this.errors = err.response.data.errors
                })
            }
        },


            //update code here
        getData: function(data_id){
            this.clearFields();
            this.fields.training_seminar_id = data_id;
            this.isModalCreate = true;

            this.fields.seminar_title = this.propData.seminar_title
            this.fields.seminar_desc = this.propData.seminar_desc
            this.fields.date_from = new Date(this.propData.date_from)
            this.fields.date_to = new Date(this.propData.date_to)
            this.fields.sponsored_by = this.propData.sponsored_by
            this.fields.speaker = this.propData.speaker
            this.fields.no_hours = this.propData.no_hours

            // //nested axios for getting the address 1 by 1 or request by request
            // axios.get('/offices/'+data_id).then(res=>{
            //     this.fields = res.data;
            // });
        },


        clearFields(){
            this.fields = {}
            this.file = null
        },

        initData(){
            if(this.propId > 0){
                console.log('test');
                this.getData()
            }
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
        this.initData()
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
