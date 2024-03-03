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
                <span v-else="search.designation === 'FACULTY'">FACULTY</span>
                <span v-else="search.designation === 'STAFF'">STAFF</span>
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

            <Bar
                id="my-chart-id"
                :options="chartOptions"
                :data="chartData"
            />
            
        </div>


    </div>
</template>

<script>

import { Bar } from 'vue-chartjs/legacy'

import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

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
            }

            
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
        renderChart() {
            const ctx = this.$refs.myChart.getContext('2d');
            const myChart = new Chart(ctx, {
                // Chart configuration options
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [65, 59, 80, 81, 56],
                    }],
                },
            });
        },
    },

    mounted(){
        this.loadReporyBySex()
        this.renderChart();
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