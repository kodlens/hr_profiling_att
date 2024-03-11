<template>
    <Bar 
        :chart-options="chartOptions" 
        :chart-data="{ labels, datasets}" 
        :chart-id="chartId" 
        :dataset-id-key="datasetIdKey"
        :plugins="plugins" 
        :css-classes="cssClasses" 
        :styles="styles" 
        :width="width" 
        :height="height" />
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

export default {
    name: 'BarChart',
    components: {
        Bar
    },
    props: {
        chartLabels: {
            type: Array,
            default: () => []
        },
        chartDataSets: {
            type: Array,
            default: () => []
        },

        chartId: {
            type: String,
            default: 'bar-chart'
        },
        datasetIdKey: {
            type: String,
            default: 'label'
        },
        width: {
            type: Number,
            default: 400
        },
        height: {
            type: Number,
            default: 400
        },
        cssClasses: {
            default: '',
            type: String
        },
        styles: {
            type: Object,
            default: () => { }
        },
        plugins: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            labels: [
                    'MALE',
                    'FEMALE',
                   
                ],
                
            datasets: [
                {
                    label: 'Data One',
                    backgroundColor: '#f87979',
                    data: [40, 20]
                }
            ],

            chartOptions: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    }
}
</script>