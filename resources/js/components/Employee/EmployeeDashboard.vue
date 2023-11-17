<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-6">
                    <div class="box box-post" v-for="(event, index) in events" :key="index">
                        <div class="box-post-heading">
                            <div class="posted-text mb-4">Posted: {{ new Date(event.created_at).toLocaleString() }}</div>
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
                                    <div class="" v-html="event.event_desc"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-img-container mt-4" v-if="event.img_path">
                            <img :src="`/storage/events/${event.img_path}`" class="post-img" />
                        </div>
                        <hr>

                        <div v-if="event.event_attachment">
                            <div class="has-text-weight-bold is-size-7 mb-2">ATTACHMENT/ATTENDANCE</div>
                            <img :src="`/storage/attachments/${event.event_attachment.img_path}`" class="attach-img" 
                                @click="opeModalViewAttachment(event)" />
                        </div>
                       <div class="buttons mt-4">
                            <b-button type="is-primary" 
                                class="is-outlined"
                                icon-left="attachment" 
                                @click="openModal(event.event_id)"
                                label="Add Attachment"></b-button>
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




        
        <!--modal create-->
        <b-modal v-model="isModalCreate" has-modal-card
            trap-focus
            :width="640"
            aria-role="dialog"
            aria-label="Modal"
            aria-modal>

          
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Upload Attachment</p>
                    <button
                        type="button"
                        class="delete"
                        @click="isModalCreate = false"/>
                </header>

                <section class="modal-card-body">
                    <div class="">

                    
                        <div class="columns">
                            <div class="column">
                                <b-field label="Description">
                                    <b-input type="text" v-model="fields.img_description" placeholder="Description..."></b-input>
                                </b-field>
                                <b-field expanded>
                                    <b-upload v-model="dropFile"
                                        drag-drop expanded>
                                        <section class="section">
                                            <div class="content has-text-centered">
                                                <p>
                                                    <b-icon
                                                        icon="upload"
                                                        size="is-large">
                                                    </b-icon>
                                                </p>
                                                <p>Drop your files here or click to upload</p>
                                            </div>
                                        </section>
                                    </b-upload>
                                </b-field>

                                <div class="tags">
                                    <span v-if="dropFile.name"
                                        class="tag is-primary" >
                                        {{dropFile.name}}
                                        <button class="delete is-small"
                                            type="button"
                                            @click="dropFile = {}">
                                        </button>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </section>

                <footer class="modal-card-foot">
                    <b-button
                        :class="btnClass"
                        @click="uploadAttachment"
                        icon-right="arrow-right-thin">Submit Attachment</b-button>
                </footer>

            </div>
      
        </b-modal>
        <!--close modal-->




        <!--modal view attachment-->
        <b-modal v-model="modalViewAttachment" has-modal-card
            trap-focus
            :width="640"
            aria-role="dialog"
            aria-label="Modal"
            aria-modal>

          
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Upload Attachment</p>
                    <button
                        type="button"
                        class="delete"
                        @click="modalViewAttachment = false"/>
                </header>

                <section class="modal-card-body">
                    <div class="" v-if="fields.img_path">
                        <div class="columns">
                            <div class="column">
                                <b-input type="text"
                                    v-model="fields.attachment.img_description"
                                    placeholder="Desctiption" />
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                
                                <img :src="`/storage/attachments/${fields.attachment.img_path}`" class="attach-img" />
                                
                            </div>
                        </div>
                    </div>
                </section>

                <footer class="modal-card-foot">
                    <b-button
                        :class="btnClass"
                        @click="uploadAttachment"
                        icon-right="view-gallery-outline">OK</b-button>
                </footer>

            </div>
      
        </b-modal>
        <!--close modal-->



    </div>
</template>

<script>
export default{

    data(){
        return{
            events:[],
            fields: {
                img_path: '',
                img_description: '',
                attachment: {},
                event_id: 0,
            },

            dropFile: {},

            isModalCreate: false,
            modalViewAttachment: false,

            btnClass: {
                'is-loading': false,
                'button': true,
                'is-primary': true
            }
        }
    },

    methods: {
        loadEvents(){
            axios.get('/employee-get-posted-events').then(res=>{
                this.events = res.data
            })
        },

        openModal(id){
            this.dropFile = {}
            this.isModalCreate = true
            this.fields.event_id = id
        },
        opeModalViewAttachment(row){
            console.log(row);
            this.modalViewAttachment = true
            this.fields.attachment.img_path = row.event_attachment.img_path
           
        },

        uploadAttachment(){
            
            this.btnClass['is-loading'] = true

            let formData = new FormData()

            formData.append('event_id', this.fields.event_id ? this.fields.event_id : '');
            formData.append('attachment', this.dropFile ? this.dropFile : '');
            formData.append('img_description', this.fields.img_description ? this.fields.img_description : '');

            axios.post('/employee-dashboard-upload-attachment',  formData).then(res=>{
                this.btnClass['is-loading'] = false
                if(res.data.status === 'uploaded'){
                    this.loadEvents()
                    this.fields.event_id = 0
                    this.isModalCreate = false
                }
               
            }).catch(err=> {
                this.btnClass['is-loading'] = false
            
            })
        },

        getAttachmentImage(eventId, userId){
            axios.get(`/get-by-user-event-attachment?eventid=${eventId}&userid=${userId}`).then(res=>{
            
            }).catch(err=>{
            
            })
        }
   

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

    .attach-img{
        height: 50px;
        margin-right: 5px;
    }
</style>
