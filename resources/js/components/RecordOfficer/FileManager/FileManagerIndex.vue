<template>
    <div>

        <div class="columns is-centered mt-5">
            <div class="column is-8">
                
                <div class="box">
                    <div class="is-flex mb-2" style="font-size: 20px; font-weight: bold;">FILES</div>
                    <div class="has-text-weight-bold">{{ propData.lname }}, {{ propData.fname }}</div>
                    <hr>
                    

                    <div class="buttons">
                        <button class="button is-primary" @click="openModalFileUpload">
                            <b-icon icon="file-cabinet" class="mr-2"></b-icon>
                            Upload file
                        </button>
                    </div>
                   
                </div> <!-- box-->
                
            </div> <!-- col-->
        </div> <!--div cols-->
        


         <!--modal reset password-->
         <b-modal v-model="modalUploadFile" has-modal-card
                trap-focus
                :width="640"
                aria-role="dialog"
                aria-label="Modal"
                aria-modal>

            <form @submit.prevent="submit">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Other Info</p>
                        <button
                            type="button"
                            class="delete"
                            @click="modalUploadFile = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <div class="columns">
                                <div class="column">

                                    <div class="columns">
                                        <div class="column">
                                            <b-field label="File Description" label-position="on-border"
                                                :type="errors.file_description ? 'is-danger':''"
                                                :message="errors.file_description ? errors.file_description[0] : ''">
                                                <b-input type="text" v-model="fields.file_description"
                                                    placeholder="File Description">
                                                </b-input>
                                            </b-field>
                                        </div>
                                    </div>
                                    <div class="columns">
                                        <div class="column">
                                            <b-field class="file is-primary" :class="{'has-name': !!fields.file}">
                                                <b-upload v-model="fields.file" class="file-label">
                                                    <span class="file-cta">
                                                        <b-icon class="file-icon" icon="upload"></b-icon>
                                                        <span class="file-label">Click to upload file</span>
                                                    </span>
                                                    <span class="file-name" v-if="fields.file">
                                                        {{ fields.file.name }}
                                                    </span>
                                                </b-upload>
                                            </b-field>
                                        </div>
                                    </div>

                                    

                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button
                            class="button is-primary">
                            <b-icon icon="upload-outline" class="mr-2"></b-icon>
                            <b>Upload</b>
                        </button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->

    </div>
</template>

<script>

export default{

    props: {
        propData: {
            type: Object,
            default: {}
        }
    },
    data() {
        return{
            modalUploadFile: false,

            files: [],

            fields: {
                file_description: null,
                file: null,
            }

        }

    },

    methods: {
        getLiistFiles(){
            axios.get('/record-officer/get-list-files/' + this.propData.user_id).then(res=>{
                this.files = res.data
            }).catch(err=>{
            
            })
        },

        openModalFileUpload(){
            this.modalUploadFile = true
        },
        submit(){
            
        }
    },

    mounted() {
        this.getLiistFiles()
    }

}
</script>


<style scoped>


</style>
