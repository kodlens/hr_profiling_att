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
                                        <th>STATUS</th>
                                        <th>ATTACHMENT</th>
                                    </tr>
                                    <tr v-for="(item,index) in attendees" :key="index">
                                        <td>{{ item.user.lname }}, {{ item.user.fname }} {{ item.user.mname }}</td>
                                        <td>
                                            <span v-if="item.attendance_status === 1" class="approved">APPROVED</span>
                                            <span v-else-if="item.attendance_status === 2" class="declined">DECLINED</span>
                                            <span v-else-if="item.attendance_status === 0" class="pending">PENDING</span>

                                        </td>
                                        <td>
                                            <img :src="`/storage/attachments/${item.img_path}`" 
                                                @click="openModalViewAttachment(item)"
                                                class="attachment-img" alt="attachment image"/>
                                        </td>
                                    </tr>
                                </table>
                               
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>


        <!--modal create-->
        <b-modal v-model="modalViewAttachment" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>


            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Attendees Attachment</p>
                    <button
                        type="button"
                        class="delete"
                        @click="modalViewAttachment = false"/>
                </header>
                <section class="modal-card-body">
                    <div class="">
                        <div class="columns">

                            <div class="column">
                                <b-field label="Attachment">
                                    <img :src="`/storage/attachments/${attachment.img_path}`" alt="attachment image"/>
                                </b-field>
                            </div>
                        </div>

                    </div> <!-- div class-->
                </section>
                <footer class="modal-card-foot">
                    <b-button
                        @click="submit(1)"
                        class="button is-outlined is-primary">Approve</b-button>
                    <b-button
                        @click="submit(2)"
                        class="button is-outlined is-danger">Decline</b-button>
                </footer>
            </div>
        </b-modal>
        <!--close modal-->
       

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
            modalViewAttachment: false,
            imagePath: '',

            attachment: {
                img_path: '',
                event_employee_attachment_id: null,
            },

            attendees: [],
        }
    },

    methods: {

        loadAttendees(){
            axios.get('/point-person/load-attendees-events-view?eventid=' + this.propEventAttendees.event_id)
                .then(res=>{
                    this.attendees = res.data
                })
        },
        openModalViewAttachment(row){
            console.log(row.event_employee_attendance_id)
            this.attachment.img_path = '';
            this.attachment.event_employee_attachment_id = null

            this.modalViewAttachment = true

            this.attachment.img_path = row.img_path
            this.attachment.event_employee_attachment_id = row.event_employee_attendance_id
        },

        submit(n){
            this.attachment.status = n
            axios.post('/point-person/events-attachment-set-status', this.attachment).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: res.data.att_status === 1 ? 'Approved.' : 'Declined.',
                        message: res.data.att_status === 1 ? 'Attachment approved successfully' : 'Declined.',
                        type: 'is-success',
                        onConfirm: ()=>{
                            this.modalViewAttachment = false
                            this.loadAttendees()
                        }
                    })
                }
            }).catch(err=>{
            
            })
        }
    },

    mounted(){
        this.loadAttendees()
    }
}
</script>

<style scoped>
    .attachment-img{
        height: 100px;
    }

    .approved, .declined, .pending {
        font-weight: bold;
        font-size: 12px;
        padding: 5px;
    }

    .approved{
        background-color: green;
        color: white;
    }

    .declined{
        background-color: red;
        color: white;
    }
    .pending{
        background-color: #1a3eb3;
        color: white;
    }
</style>