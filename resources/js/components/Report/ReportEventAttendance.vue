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
                <div class="has-text-weight-bold has-text-centered mt-4">EVENT ATTENDANCE</div>
                <div class="has-text-weight-bold has-text-centered">{{ event.event_title }}</div>
               <table class="table mt-4" style="margin: auto;">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Sex</td>
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
            event: {},
        }
    },

    methods: {

         loadEvent(){
            axios.get(`/load-event-name/${this.propId}`).then(res=>{
                this.event = res.data
            }).catch(err=>{
                throw err
            })
        },

        loadAttendances(){
             const params = [
                `id=${this.propId}`,
            ].join('&')

            axios.get(`/load-event-attendances?${params}`).then(res=>{
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
        this.loadEvent()
        this.loadAttendances()
        console.log('test');
    }
}
</script>
