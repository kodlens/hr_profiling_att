<template>
    <div>
        <div class="print-form">
            <h2 class="divider nprint"><span>FILTER</span></h2>
            <div class="columns m-2 nprint">
                <div class="column nprint">
                    <b-field label="Sex">
                        <b-radio v-model="fields.sex"
                            name="sex"
                            native-value="all">
                            ALL
                        </b-radio>
                        <b-radio v-model="fields.sex"
                            name="sex"
                            native-value="male">
                            MALE
                        </b-radio>
                        <b-radio v-model="fields.sex"
                            name="sex"
                            native-value="female">
                            FEMALE
                        </b-radio>
                    </b-field>
                </div>
                <div class="column nprint">
                    <b-field label="Select age range"
                        expanded>
                        <b-select v-model="fields.range" expanded>
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
            </div>

            <div class="columns ml-2 nprint">
                <div class="column nprint">
                    <b-field label="Status of Engagement">
                        <b-field v-for="(item,index) in engagementStatus" :key="`engagement${index}`">
                            <b-checkbox  
                                v-model="fields.engagement_status[index]"
                                :true-value="item.engagement_status"
                                :false-value="``">
                                {{ item.engagement_status }}
                            </b-checkbox>
                        </b-field>
                    </b-field>
                </div>
                <div class="column nprint">
                    <b-field label="Educational Background">
                        <b-input v-model="fields.education" placeholder="Educational Background" />
                    </b-field>
                    <b-field label="Eligibility">
                        <b-input v-model="fields.eligibility" placeholder="Eligibility" />
                    </b-field>
                    <b-field label="Learning Development">
                        <b-input v-model="fields.learning_dev" placeholder="Learning Development" />
                    </b-field>
                </div>
            </div>

            <h2 class="divider nprint"><span>SHOW FIELDS</span></h2>

            <div class="columns nprint">
                <div class="column nprint">

                    <div>

                        <b-field label="SELECT FIELDS TO SHOW">
                            <b-checkbox v-model="show.civil_status"
                                :true-value="true"
                                :false-value="false">
                                CIVIL STATUS
                            </b-checkbox>
                            <b-checkbox v-model="show.birthdate"
                                :true-value="true"
                                :false-value="false">
                                BIRTHDATE
                            </b-checkbox>
                            <b-checkbox v-model="show.GSIS"
                                :true-value="true"
                                :false-value="false">
                                GSIS
                            </b-checkbox>
                            <b-checkbox v-model="show.pagibig"
                                :true-value="true"
                                :false-value="false">
                                PAGIBIG
                            </b-checkbox>
                            <b-checkbox v-model="show.philhealth"
                                :true-value="true"
                                :false-value="false">
                                PHILHEALTH
                            </b-checkbox>
                            <b-checkbox v-model="show.sss"
                                :true-value="true"
                                :false-value="false">
                                SSS
                            </b-checkbox>
                            <b-checkbox v-model="show.tin"
                                :true-value="true"
                                :false-value="false">
                                TIN
                            </b-checkbox>
                        </b-field>
                    </div>

                    <div class="mt-2">
                        <b-checkbox v-model="show.engagement"
                            :true-value="true"
                            :false-value="false">
                            ENGAGEMENT
                        </b-checkbox>
                        <b-checkbox v-model="show.agency_idno"
                            :true-value="true"
                            :false-value="false">
                            AGENCY ID NO.
                        </b-checkbox>
                        <b-checkbox v-model="show.eligibility"
                            :true-value="true"
                            :false-value="false">
                            ELIGIBILITY
                        </b-checkbox>
                        <b-checkbox v-model="show.education"
                            :true-value="true"
                            :false-value="false">
                            EDUCATION
                        </b-checkbox>
                        <b-checkbox v-model="show.ld"
                            :true-value="true"
                            :false-value="false">
                            LEARNING DEV.
                        </b-checkbox>
                    </div>
                 
                </div>
            </div>

            <div class="columns nprint">
                <div class="column">
                    <div class="buttons">
                        <b-button icon-right="magnify" label="SEARCH"   @click="loadReport">
                        </b-button>

                        <b-button icon-right="printer" label="PRINT PREVIEW"   @click="printPreview">
                        </b-button>
                    </div>
                </div>
            </div>

            <div class="has-text-weight-bold has-text-centered">GENERAL REPORT</div>


            <div class="mt-5">
                <table class="table is-narrow">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>SEX</th>
                            <th v-if="show.civil_status">CIVIL STATUS</th>
                            <th v-if="show.birthdate">BIRTHDAY</th>
                            <th v-if="show.gsis">GSIS</th>
                            <th v-if="show.pagibig">PAGIBIG</th>
                            <th v-if="show.philhealth">PHILHEALTH</th>
                            <th v-if="show.sss">SSS</th>
                            <th v-if="show.tin">TIN</th>
                            <th v-if="show.engagement">ENGAGEMENT</th>
                            <th v-if="show.agency_idno">AGENCY ID NO.</th>
                            <th v-if="show.eligibility">ELIGIBILITY</th>
                            <th v-if="show.education">EDUCATION</th>
                            <th v-if="show.ld">LEARNING DEVELOPMENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data" :key="`data${index}`">
                            <td>{{ item.lname }}, {{ item.fname }} {{ item.mname }} <span v-if="item.suffix">{{ item.suffix }}</span></td>
                            <td>{{ item.sex }}</td>
                            <td v-if="show.civil_status">{{ item.civil_status }}</td>
                            <td v-if="show.birthdate">{{ new Date(item.date_birth).toLocaleDateString() }}</td>
                            <td v-if="show.gsis">{{ item.gsis }}</td>
                            <td v-if="show.pagibig">{{ item.pagibig }}</td>
                            <td v-if="show.philhealth">{{ item.philhealth }}</td>
                            <td v-if="show.sss">{{ item.sss }}</td>
                            <td v-if="show.tin">{{ item.tin }}</td>
                            <td v-if="show.engagement">
                                <span v-if="item.engagement">{{ item.engagement.engagement_status }}</span>
                            </td>
                            <td v-if="show.agency_idno"><span v-if="item.agency_idno">{{ item.agency_idno }}</span></td>
                            <td v-if="show.eligibility">
                                <span v-if="item.eligibilities">
                                    <div v-for="(el, ix) in item.eligibilities" :key="`el${ix}`">
                                        {{ el.career_exam }} - {{ el.rating }}, 
                                    </div>
                                </span>
                            </td>
                            <td v-if="show.education">
                                <span v-if="item.educational_backgrounds">
                                    <div v-for="(ed, idx) in item.educational_backgrounds" :key="`ed${idx}`">
                                        {{ ed.level }} - {{ ed.name_of_school }} - {{ ed.degree }}, 
                                    </div>
                                </span>
                            </td>
                            <td v-if="show.ld">
                                <span v-if="item.learning_developments">
                                    <div v-for="(ld, idx) in item.learning_developments" :key="`ed${idx}`">
                                        {{ ld.title_learning_dev }} - {{ ld.type_ld }}, 
                                    </div>
                                </span>
                            </td>

                            
                        </tr>

                    </tbody>
                </table>
            </div>

        </div> <!-- print form-->



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

            fields: {
                sex: 'all',
                range: '',
                engagement_status: [],
                learning_dev: '',
                education: '',
                eligibility: '',

            },

            show:{
                birthdate: false,
                gsis: false,
                pagibig: false,
                sss: false,
                philhealth: false,
                tin: false,
                ld: false,
                eligibility: false,
                education: false,
            },


           
            data: [],

            engagementStatus: [],
            sex: [],


        

        }
    },

    methods: {
        loadReport(){
            const params = [
                `range=${this.fields.range}`,
                `sex=${this.fields.sex}`,
                `engagement=${this.fields.engagement_status}`,
                `education=${this.fields.education}`,
                `eligibility=${this.fields.eligibility}`,
                `learningdev=${this.fields.learning_dev}`

            ].join('&')


            axios.get(`/report-load-general-report?${params}`).then(res=>{
                this.data = res.data
            })
        },

        printPreview(){
            window.print()
        },



        loadEngagementStatus(){
            axios.get('/load-engagement-status').then(res=>{
                this.engagementStatus = res.data
            })
        },

        loadSex(){
            axios.get('/load-sex').then(res=>{
                this.sex = res.data
            })
        }

    },

    mounted(){
        this.loadSex()
        this.loadEngagementStatus()

        //this.loadReport()
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
