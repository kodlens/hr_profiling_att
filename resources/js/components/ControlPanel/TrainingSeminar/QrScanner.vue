<template>
    <div>

        <div class="section">

            <div class="columns is-centered">
                <div class="column">


                    <div class="qr-container">
                        <b-field label="QR SCANNER"></b-field>
                        <div class="camera mb-2">
                            <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">


                                <!-- <div v-if="validationFailure" class="validation-failure">
                                    {{ remark }}
                                </div> -->

                                <div v-if="validationPending" class="validation-pending">
                                    Processing...
                                </div>
                            </qrcode-stream>
                        </div>
                        <b-field label="Attendance Status"
                            :type="this.errors.attendance_status ? 'is-danger':''"
                            :message="this.errors.attendance_status ? this.errors.attendance_status[0] : ''">

                            <b-select v-model="fields.attendance_status" expanded>
                                <option value="in_am">IN AM</option>
                                <option value="out_am">OUT AM</option>
                                <option value="in_pm">IN PM</option>
                                <option value="out_pm">OUT PM</option>
                            </b-select>
                        </b-field>

                        <div class="buttons mt-1 is-centered">
                            <b-button @click="turnCameraOn" label="TURN ON"></b-button>
                            <b-button @click="turnCameraOff" label="TURN OFF"></b-button>
                        </div>
                        <!-- <p class="decode-result">QR Code: <b>{{ result }}</b></p> -->

                    </div> <!-- qr-container-->
                    
                </div>
            </div>
          
           

          
        </div>
        <!--section -->


    </div><!--root-->

</template>



<script>
export default {
    data(){
        return{
        
            isValid: undefined,
            camera: 'off',
            result: null,
            isProcessing: false,


            fields: {},
            errors: {},
        }
    },
    methods: {
        onInit (promise) {
            promise
                .catch(console.error)
                .then(this.resetValidationState)
        },

        resetValidationState () {
            this.isValid = undefined
        },

        async onDecode (content) {
            this.result = content;
            this.turnCameraOff();
            const jsonResult = JSON.parse(content)
     
            // pretend it's taking really long
            this.isProcessing = true;
  
            await this.timeout(2000);

            axios.post('/qr-scanner/', {
                'user_id' : jsonResult.user_id,
                'training_seminar_id': jsonResult.training_seminar_id,
                'attendance_status': this.fields.attendance_status
            }).then(res=>{
                this.isProcessing = false;
                this.isValid = true;
                if(res.data.status === 'saved'){
                    this.$buefy.toast.open({
                        type: 'is-success',
                        message: 'Attendance recorded successfully.'
                    })
                }
            }).catch(err=>{
                this.isProcessing = false;
                console.log(err.response.data.status);

                if(err.response.status === 422){
                    this.errors = err.response.data.errors
        
                    if(this.errors.user){
                        this.$buefy.toast.open({
                            type: 'is-danger',
                            message: this.errors.user[0]
                        })
                    }

                    if(this.errors.attendance){
                        this.$buefy.toast.open({
                            type: 'is-danger',
                            message: this.errors.attendance[0]
                        })
                    }
                   
                    this.isValid = false;
                }

            })
            //this.isValid = content.startsWith('http') //this will return boolean value

            // some more delay, so users have time to read the message
            await this.timeout(2000);
            this.turnCameraOn()
        },

        turnCameraOn () {
            this.camera = 'auto';
        },

        turnCameraOff () {
            this.camera = 'off'
        },

        timeout (ms) {
            return new Promise(resolve => {
                window.setTimeout(resolve, ms)
            })
        },

        submit: function(){
            axios.post('/save-frisk-item/' + this.user.appointment_id, this.fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.isModalValidModal = false;
                    this.$buefy.toast.open({
                        message: 'Frisk item save successfully.',
                        type: 'is-success'
                    });

                    this.fields = {
                        friskItems: [],
                    };
                }
            })
        },

        add () {
            this.fields.friskItems.push({
                item_name: '',
            })
        },
        remove(index){
            //alert(index);
            this.fields.friskItems.splice(index, 1);
        },

    },

    computed: {
        validationPending() {
            return this.isProcessing;
        },

        validationSuccess() {

            return this.isValid === true
        },

        validationFailure() {
            return this.isValid === false
        },
    },
}
</script>

<style scoped>
.validation-success,
.validation-failure,
.validation-pending {
    position: absolute;
    width: 100%;
    height: 100%;

    background-color: rgba(255, 255, 255, .8);
    text-align: center;
    font-weight: bold;
    font-size: 1.4rem;
    padding: 10px;

    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
}
.validation-success {
    color: green;
}
.validation-failure {
    color: red;
}

.camera{
    margin: auto;
    width: 240px;
    height: 320px;
    border: 1px solid gray;
}

.decode-result{
    text-align: center;
}

.qr-container{
    width: 300px;
    margin: auto;
}




.visitor-img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;

}

.companion{
    margin: 15px 0 10px 25px;
}

.frisk-item-wrapper{
    max-height: 200px;
    overflow: auto;
}
</style>