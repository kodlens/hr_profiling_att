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
                        <b-button icon-right="printer" label="PRINT PREVIEW"   @click="printPreview">
                        </b-button>
                    </div>
                </div>
            </div>

            <div class="columns">

            </div>

            <div class="has-text-weight-bold has-text-centered">REPORT BY EDUCATIONAL BACKGROUND

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

            <div class="mt-5">
                <Bar 
                    :chart-options="chartOptions" 
                    :chart-data="{ labels, datasets }" 
                    :chart-id="chartId" 
                    :dataset-id-key="datasetIdKey"
                    :plugins="plugins" 
                    :css-classes="cssClasses" 
                    :styles="styles" 
                    :width="width" 
                    :height="height" />
            </div>

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
    components: {
        Bar,
    },

    data(){
        return {

            chartId: 'bar-chart',
            datasetIdKey: 'label',
            width: 400,
            height: 400,
            cssClasses: '',
            styles: { },
            plugins: [],
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false
            },



            search: {
                designation: '',
                data: [],
            },

            data: [],

        

        }
    },

    methods: {
        loadReporyBySex(){
            const params = [

                `designation=${this.search.designation}`,

            ].join('&')


            axios.get(`/report-load-report-by-educational-background?${params}`).then(res=>{
                this.data = res.data
            })
        },

        printPreview(){
            window.print()
        }

    },

    mounted(){
        this.loadReporyBySex()
       // this.renderChart();
    },
    
    computed: {
        datasets: function(){
            //console.log(this.data);
            let arr = this.data.map(function(i){
                return i.count
            });
            //console.log(arr)
            let obj = {
                label: 'Sex',
                backgroundColor: '#f87979',
                data: arr
            };

            return [obj];
        },

        labels: function() {
            let arr = this.data.map(function(i){
                return i.sex
            });

            return arr;
        }
            
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
