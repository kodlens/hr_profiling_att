<template>
    <div>
        <div class="print-form">

            <div class="print-header">
                <img src="/img/logo.png" height="50px" width="50px"><h3><b>Tangub City Global College</b></h3>
            </div>

            <div class="columns m-2 nprint">
                <!-- <div class="column nprint">
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
                </div> -->
                <div class="column">
                    <div class="buttons">
                        <b-button icon-right="printer" label="PRINT PREVIEW"   @click="printPreview">
                        </b-button>
                    </div>
                </div>
            </div>

            <div class="has-text-weight-bold has-text-centered">REPORT BY STATUS OF APPOINTMENT
            </div>
            <div class="data-section has-text-centered">
                    <ul>
                        <li v-for="(item, index) in data" :key="index">
                            <i>{{ item.engagement_status }}:</i> <i>{{ item.count }}</i>
                        </li>
                    </ul>
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

              <!-- Footer for Print -->
              <div class="print-footer">
                <p>Human Resource Management Office Page  <span class="pageNumber" display="none"></span></p>
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


            axios.get(`/report-load-report-by-engagement-status?${params}`).then(res=>{
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
                label: 'Engagement Status',
                backgroundColor: '#f87979',
                data: arr
            };

            return [obj];
        },

        //this labels is for the graph caption
        labels: function() {
            let arr = this.data.map(function(i){
                return i.engagement_status //column name from database
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

     /* Hide the header in the interface */
     .print-header {
        display: none;
    }

    /* Hide the footer in the interface */
    .print-footer {
        display: none;
    }

    /* Print-specific styles */
    @media print {
        body * {
            visibility: hidden;
        }
        .print-form, .print-form * {
            visibility: visible;
        }
        .print-form {
            position: absolute;
            left: 0;
            top: 0;
        }
        .print-header {
            display: block; /* Show the header only during print */
            position: fixed;
            top: 0;
            width: 100%;
            text-align: center;
            border-bottom: 1px solid black;
            padding-bottom: 10px;
        }
        .print-footer {
            display: block; /* Show the footer only during print */
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            border-top: 1px solid black;
            padding-top: 10px;
            counter-increment: page;
        }
        .print-footer .pageNumber::before {
            content: counter(page);
        }
        .print-form {
            margin-top: 100px; /* Adjust top margin to avoid overlap with header */
            margin-bottom: 50px; /* Adjust bottom margin to avoid overlap with footer */
        }
    }

    @page {
        counter-increment: page;
        counter-reset: page 1; /* Start page numbering at 1 */
    }

</style>
