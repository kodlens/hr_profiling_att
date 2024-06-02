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
                            <td>Time In (AM)</td>
                            <td>Time Out (AM)</td>
                            <td>Time In (PM)</td>
                            <td>Time Out (PM)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in transformedData" :key="`data${index}`">
                            <td>{{ item.name }}</td>
                            <td>{{ item.sex }}</td>
                            <td>{{ item.timeInAM }}</td>
                            <td>{{ item.timeOutAM }}</td>
                            <td>{{ item.timeInPM }}</td>
                            <td>{{ item.timeOutPM }}</td>
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
        return {
            data: [],
            training: {},
            transformedData: []
        }
    },

    methods: {
        loadTraining() {
            axios.get(`/load-training-name/${this.propId}`).then(res => {
                this.training = res.data
            }).catch(err => {
                throw err
            })
        },

        loadAttendances() {
            const params = [
                `id=${this.propId}`,
            ].join('&')

            axios.get(`/load-training-attendances?${params}`).then(res => {
                this.data = res.data
                this.transformData()
            }).catch(err => {
                throw err
            })
        },

        transformData() {
            const tempData = {}

            this.data.forEach(item => {
                const name = `${item.user.lname}, ${item.user.fname} ${item.user.mname}`
                if (!tempData[name]) {
                    tempData[name] = {
                        name,
                        sex: item.user.sex,
                        timeInAM: '',
                        timeOutAM: '',
                        timeInPM: '',
                        timeOutPM: ''
                    }
                }

                const time = new Date(item.datetime_scanned).toLocaleTimeString()

                if (item.attendance_status === 'in_am') {
                    tempData[name].timeInAM = time
                } else if (item.attendance_status === 'out_am') {
                    tempData[name].timeOutAM = time
                } else if (item.attendance_status === 'in_pm') {
                    tempData[name].timeInPM = time
                } else if (item.attendance_status === 'out_pm') {
                    tempData[name].timeOutPM = time
                }
            })

            this.transformedData = Object.values(tempData)
        },

        print() {
            window.print()
        }
    },

    mounted() {
        this.loadTraining()
        this.loadAttendances()
    }
}
</script>


