<template>
    <div>
        <div class="print-form">

            <div class="columns m-2 nprint">
                <div class="column nprint">
                    <b-field label="Select designation" label-position="on-border"
                        expanded>
                        <b-select v-model="search.designation" expanded
                            @input="loadReporyBySex">
                            <option value="">ALL</option>
                            <option value="FACULTY">FACULTY</option>
                            <option value="STAFF">STAFF</option>
                        </b-select>
                    </b-field>
                </div>
                <div class="column">
                    <div class="buttons">
                        <b-button icon-right="printer" label="PRINT PREVIEW">
                        </b-button>
                    </div>
                </div>
            </div>

            <div class="columns">

            </div>

            <div class="has-text-weight-bold has-text-centered">REPORT BY SEX

                <span v-if="search.designation === ''">ALL</span>
                <span v-else-if="search.designation === 'FACULTY'">FACULTY</span>
                <span v-else-if="search.designation === 'STAFF'">STAFF</span>
            </div>

            <table class="report-table">
                <tr>
                    <th>Sex</th>
                    <th>Count</th>
                </tr>
                <tr v-for="(item,index) in data" :key="`sex${index}`">
                    <td>{{ item.sex }}</td>
                    <td>{{ item.count }}</td>
                </tr>
            </table>
        </div>


        <div class="section">

            <BarChart />

        </div>


    </div>
</template>

<script>

import BarChart from '../Bar.vue;


export default{

    data(){
        return {
            search: {
                designation: '',
                data: [],
            },

            data: [],
            chartData: {
                labels: [ 'January', 'February', 'March' ],
                datasets: [ { data: [40, 20, 12] } ]
            },
            chartOptions: {
                responsive: true
            },



        }
    },

    methods: {
        loadReporyBySex(){
            const params = [

                `designation=${this.search.designation}`,

            ].join('&')


            axios.get(`/report-load-report-by-sex?${params}`).then(res=>{
                this.data = res.data
            })
        },

    },

    mounted(){
        this.loadReporyBySex()
       // this.renderChart();
    }
}
</script>


<style scoped>
    .report-table{
        max-width: 400px;
        margin: 10px auto;
    }

    .report-table tr th{
        padding: 3px 10px;
    }

    .report-table tr td{
        padding: 3px 10px;
    }

</style>
