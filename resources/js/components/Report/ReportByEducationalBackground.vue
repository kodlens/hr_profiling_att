<template>
    <div>
        <div class="print-form">

            <div class="print-header">
                <img src="/img/logo.png" height="50px" width="50px"><h3><b>Tangub City Global College</b></h3>
</div>

            <div class="columns m-2 nprint">
                <div class="column nprint">
                    <b-field label="Select designation" label-position="on-border" expanded>
                        <b-select v-model="search.designation" expanded @input="loadReport">
                            <option value="">ALL</option>
                            <option value="FACULTY">FACULTY</option>
                            <option value="STAFF">STAFF</option>
                        </b-select>
                    </b-field>
                </div>
                <div class="column">
                    <div class="buttons">
                        <b-button icon-right="printer" label="PRINT PREVIEW" @click="printPreview">
                        </b-button>
                    </div>
                </div>
            </div>

            <div class="has-text-weight-bold has-text-centered">
                REPORT BY EDUCATIONAL BACKGROUND
                <span v-if="search.designation === ''">ALL</span>
                <span v-else-if="search.designation === 'FACULTY'">FACULTY</span>
                <span v-else-if="search.designation === 'STAFF'">STAFF</span>
            </div>
            
            <table class="report-table">
                <tr>
                    <th>Level</th>
                    <th>Count</th>
                </tr>
                <tr v-for="(item, index) in data" :key="`level${index}`">
                    <td>{{ item.level }}</td>
                    <td>{{ item.count_level }}</td>
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

            search: {
                designation: '',
                data: [],
            },

            data: [],
        }
    },

    methods: {
        loadReport(){
            const params = [
                `designation=${this.search.designation}`,
            ].join('&')

            axios.get(`/report-load-report-by-educational-backgrounds?${params}`).then(res=>{
                // Sort the data before assigning it
                //this.data = res.data.sort((a, b) => a.level.localeCompare(b.level));
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
        datasets: function(){
            let arr = this.data.map(i => i.count_level);
            let obj = {
                label: 'Level',
                backgroundColor: '#f87979',
                data: arr
            };
            return [obj];
        },

        labels: function() {
            //let arr = this.data.map(i => i.level);
            let arr = ['ELEMENTARY', 'SECONDARY', 'VOCATIONAL/TRADE COURSE', 'COLLEGE', 'GRADUATE STUDIES']
            return arr;
        },

        sortedData: function() {
            const customOrder = ['ELEMENTARY', 'SECONDARY', 'VOCATIONAL/TRADE COURSE', 'COLLEGE', 'GRADUATE STUDIES'];

            // return this.data.sort((a, b) => a.level.localeCompare(b.level));
            this.data.sort((a, b) => {
                return customOrder.indexOf(a.level) - customOrder.indexOf(b.level);
            });
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
