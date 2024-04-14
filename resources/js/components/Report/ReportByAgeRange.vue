<template>
    <div>
        <div class="print-form">

            <div class="columns m-2 nprint">
                <div class="column nprint">
                    <b-field label="Select age range" label-position="on-border"
                        expanded>
                        <b-select v-model="range" expanded
                            @input="loadReport">
                            <option value="15-20">15-20</option>
                            <option value="21-25">21-25</option>
                            <option value="26-30">26-30</option>
                            <option value="31-35">31-35</option>
                            <option value="36-40">36-40</option>
                            <option value="41-45">41-45</option>
                            <option value="46-50">46-50</option>
                            <option value="51-55">51-55</option>
                            <option value="56-60">56-60</option>
                            <option value="61-65">61-65</option>
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

            <div class="has-text-weight-bold has-text-centered">REPORT BY AGE RANGE
            </div>


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


           range: '',
           
            data: [],

        

        }
    },

    methods: {
        loadReport(){
            const params = [

                `range=${this.range}`,

            ].join('&')


            axios.get(`/report-load-report-by-age-ranges?${params}`).then(res=>{
                this.data = res.data
            })
        },

        printPreview(){
            window.print()
        }

    },

    mounted(){
        this.loadReport()
    },
    
    computed: {

        //this dataset is for count
        datasets: function(){
            let arr = this.data.map(function(i){
                return i.count //count column name from database
            });
            //console.log(arr)
            let obj = {
                label: 'Age Count',
                backgroundColor: '#f87979',
                data: arr
            };

            return [obj];
        },

        //this labels is for the graph caption
        labels: function() {
            let arr = this.data.map(function(i){
                return i.designation //column name from database
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
