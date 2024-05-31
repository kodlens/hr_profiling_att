<template>
    
    <div>
        <div class="columns is-centered">
            <div class="column is-8">
                <div class="buttons mt-6">
                    <b-button @click="print" label="Print"></b-button>
                </div>
            </div>
        </div>

        <div class="columns is-centered">
            <div class="column is-8">
                <div class="has-text-weight-bold has-text-centered mt-4">TRAINING/SEMINAR ATTENDANCE</div>
                <div class="has-text-weight-bold has-text-centered">{{ training.seminar_title }}</div>
               <table class="table mt-4" style="margin: auto;">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Sex</td>
                        <td>Date & Time</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data" :key="`data${index}`">
                        <td>
                            {{ item.user.lname }}, {{item.user.fname}} {{item.user.mname}}
                        </td>
                        <td>
                            <span v-if="item.user.sex">{{item.user.sex}}</span>
                        </td>
                        <td>
                            <span v-if="item.datetime_scanned">{{ new Date(item.datetime_scanned).toLocaleString()}}</span>
                        </td>
                        <td>
                            <span v-if="item.attendance_status === 'in_am'">IN AM</span>
                            <span v-if="item.attendance_status === 'in_pm'">IN PM</span>
                            <span v-if="item.attendance_status === 'out_am'">OUT AM</span>
                            <span v-if="item.attendance_status === 'out_pm'">OUT PM</span>
                        </td>
                    </tr>
                </tbody>
               </table>
            </div>
        </div>

    </div>


</template>


<script>

export default {
    props: {
        propId: {
            type: Number,
            default: 0
        }
    },

    data() {
        return  {
            data: [],
            training: {},
        }
    },

    methods: {

        loadTraining(){
            axios.get(`/load-training-name/${this.propId}`).then(res=>{
                this.training = res.data
            }).catch(err=>{
                throw err
            })
        },

        loadAttendances(){
             const params = [
                `id=${this.propId}`,
            ].join('&')

            axios.get(`/load-training-attendances?${params}`).then(res=>{
                this.data = res.data
            }).catch(err=>{
                throw err
            })
        },

        print(){
            window.print()
        }
    },

    mounted(){
        this.loadTraining()
        this.loadAttendances()
        console.log('test');
    }
}
</script>
