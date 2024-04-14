<template>
    <div>

        <div class="columns is-centered mt-5">
            <div class="column is-8">
                
                <div class="box">
                    <div class="is-flex mb-2" style="font-size: 20px; font-weight: bold;">FILES</div>
                    <div class="has-text-weight-bold">{{ propData.lname }}, {{ propData.fname }}</div>
                    <hr>
                    
                    <table class="table">
                        <tr>
                            <th>File Description</th>
                            <!-- <th>File</th> -->
                            <th>File Type</th>
                        </tr>
                        <tr v-for="(item, index) in files" :key="`file${index}`">
                            <td>
                                <a :href="`/storage/upload_files/${item.file_dir}`">
                                    {{ item.file_description }}
                                </a>
                            </td>
                        
                            <td>{{ item.file_type }}</td>
                            <td>
                                <b-button class="is-small" type="is-primary" 
                                    icon-right="delete-outline"
                                    @click="confirmDelete(item.file_manager_id)"></b-button>
                            </td>
                        </tr>
                    </table>
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
            },

            errors: {},

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

            let formData = new FormData();
        
            formData.append('file_description', this.fields.file_description ? this.fields.file_description : '');
            formData.append('file', this.fields.file ? this.fields.file : '');

            axios.post('/record-officer/files-manager/' + this.propData.user_id, formData).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'Uploaded.',
                        message: 'File successfully uploaded.',
                        type: 'is-success',
                        onConfirm: () => {
                            this.clearFields()
                            this.getLiistFiles()
                            this.modalUploadFile = false
                        }
                    })
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors
                }
            })
        },

        confirmDelete(id){
            this.$buefy.dialog.confirm({
                title: 'Remove?',
                type: 'is-danger',
                message: 'Are you sure you want to remove this file?',
                cancelText: 'Cancel',
                confirmText: 'Remove',
                onConfirm: () => this.deleteSubmit(id)
            });

          
        },

        deleteSubmit(id){
            axios.delete('/record-officer/files-manager-delete/' + id).then(res=>{
                this.$buefy.dialog.alert({
                    title: 'Removed.',
                    message: 'File successfully removed.',
                    type: 'is-success',
                    onConfirm: () => {
                        this.getLiistFiles()
                    }
                })
            })
        },


        clearFields(){
            this.fields.file_description = ''
            this.fields.file = null
        }
    },

    mounted() {
        this.getLiistFiles()
    }

}
</script>


<style scoped>


</style>
