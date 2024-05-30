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
                            <option value="all">ALL</option>
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
                    <b-field label="Civil Status">
                        <b-field v-for="(item,ix) in civilStatus" :key="`civil${ix}`">
                            <b-checkbox  
                                v-model="fields.civil_status[ix]"
                                :true-value="item.civil_status"
                                :false-value="``">
                                {{ item.civil_status }}
                            </b-checkbox>
                        </b-field>
                    </b-field>
                </div>

                <div class="column nprint">
                    <b-field label="Educational Background">
                        <b-input v-model="fields.education" placeholder="Educational Background" />
                        <p class="control">
                            <span class="button">
                                <b-radio v-model="reportTitle"
                                    name="reportTitle"
                                    native-value="EDUCATIONAL BACKGROUND REPORT">
                                </b-radio>
                            </span>
                        </p>
                    </b-field>
                   
                    <b-field label="Eligibility">
                        <b-input v-model="fields.eligibility" placeholder="Eligibility" />
                        <p class="control">
                            <span class="button">
                                <b-radio v-model="reportTitle"
                                    name="reportTitle"
                                    native-value="ELIGIBILITY REPORT">
                                </b-radio>
                            </span>
                        </p>
                    </b-field>
                    <b-field label="Learning Development">
                        <b-input v-model="fields.learning_dev" placeholder="Learning Development" />
                        <p class="control">
                            <span class="button">
                                <b-radio v-model="reportTitle"
                                    name="reportTitle"
                                    native-value="LEARNING AND DEVELOPEMENT REPORT">
                                </b-radio>
                            </span>
                        </p>
                    </b-field>
                    <b-field label="Work Experience">
                        <b-input v-model="fields.work_ex" placeholder="Work Experience" />
                        <p class="control">
                            <span class="button">
                                <b-radio v-model="reportTitle"
                                    name="reportTitle"
                                    native-value="WORK EXPERIENCE REPORT">
                                </b-radio>
                            </span>
                        </p>
                    </b-field>
                    <b-field label="Voluntary Work">
                        <b-input v-model="fields.voluntary" placeholder="Voluntary Work" />
                        <p class="control">
                            <span class="button">
                                <b-radio v-model="reportTitle"
                                    name="reportTitle"
                                    native-value="VOLUNTARY WORK REPORT">
                                </b-radio>
                            </span>
                        </p>
                    </b-field>
                </div>
            </div>

            <h2 class="divider nprint"><span>SHOW FIELDS</span></h2>

            <div class="columns nprint">
                <div class="column nprint">

                    <div>

                        <b-field label="SELECT FIELDS TO SHOW">
                            <b-checkbox v-model="show.age"
                                :true-value="true"
                                :false-value="false">
                                AGE
                            </b-checkbox>
                            <b-checkbox v-model="show.height"
                                :true-value="true"
                                :false-value="false">
                                HEIGHT
                            </b-checkbox>
                            <b-checkbox v-model="show.weight"
                                :true-value="true"
                                :false-value="false">
                                WEIGHT
                            </b-checkbox>
                            <b-checkbox v-model="show.blood"
                                :true-value="true"
                                :false-value="false">
                                BLOOD TYPE
                            </b-checkbox>
                            <b-checkbox v-model="show.permanent_address"
                                :true-value="true"
                                :false-value="false">
                                PERMANENT ADDRESS
                            </b-checkbox>
                            <b-checkbox v-model="show.children"
                                :true-value="true"
                                :false-value="false">
                                CHILDREN
                            </b-checkbox>

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
                            <b-checkbox v-model="show.gsis"
                                :true-value="true"
                                :false-value="false">
                                GSIS
                            </b-checkbox>
                            <b-checkbox v-model="show.pagibig"
                                :true-value="true"
                                :false-value="false">
                                PAGIBIG
                            </b-checkbox>
                        </b-field>
                    </div>

                    <div class="mt-2">
                       
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

                    <div class="mt-2">
                        <b-checkbox v-model="show.voluntary"
                            :true-value="true"
                            :false-value="false">
                            VOLUNTARY WORK
                        </b-checkbox>
                        <b-checkbox v-model="show.work_ex"
                            :true-value="true"
                            :false-value="false">
                            WORK EXPERIENCE
                        </b-checkbox>
                    </div>
                 
                </div>
            </div>

            <div class="columns nprint">
                <div class="column">
                    <div class="buttons">
                        <b-button icon-right="magnify"
                            type="is-success" label="SEARCH" @click="loadReport">
                        </b-button>

                        <b-button icon-right="printer"
                            type="is-info" label="PRINT PREVIEW"  @click="printPreview">
                        </b-button>

                        <b-button icon-right="restart"
                            type="is-danger" label="RESET"  @click="resetFilter">
                        </b-button>
                        
                    </div>
                </div>
            </div>

            <div class="has-text-weight-bold has-text-centered">
                <span>{{ reportTitle }}</span>
            </div>


            <div class="mt-5">
                <!-- <table class="table is-narrow">
                    <thead>
                        <tr>
                            <th @click="sortField('lname')">NAME</th>
                            <th @click="sortField('sex')">SEX</th>
                            <th @click="sortField('date_birth')" v-if="show.age">AGE</th>
                            <th v-if="show.height">HEIGHT</th>
                            <th v-if="show.weight">WEIGHT</th>
                            <th v-if="show.blood">BLOOD</th>
                            <th v-if="show.permanent_address">PERMANENT ADDRESS</th>
                            <th v-if="show.children">CHILDREN</th>

                            <th @click="sortField('civil_status')" v-if="show.civil_status">CIVIL STATUS</th>
                            <th sortable v-if="show.birthdate">BIRTHDAY</th>
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
                            <th v-if="show.voluntary">VOLUNTARY WORK</th>
                            <th v-if="show.work_ex">WORK EXPERIENCE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data" :key="`data${index}`">
                            <td>{{ item.lname }}, {{ item.fname }} {{ item.mname }} <span v-if="item.suffix">{{ item.suffix }}</span></td>
                            <td>{{ item.sex }}</td>
                            <td v-if="show.age">
                                <span v-if="item.date_birth">
                                    {{ calculateAge(item.date_birth) }}
                                </span>
                            </td>
                            <td v-if="show.height">
                                <span v-if="item.height">
                                    {{ item.height }}
                                </span>
                            </td>
                            <td v-if="show.weight">
                                <span v-if="item.weight">
                                    {{ item.weight }}
                                </span>
                            </td>
                            <td v-if="show.blood">
                                <span v-if="item.blood_type">
                                    {{ item.blood_type }}
                                </span>
                            </td>
                            <td v-if="show.permanent_address">
                                <span v-if="item.permanent_province">
                                    {{ item.permanent_province.provDesc }}
                                </span>
                                <span v-if="item.permanent_city">
                                    , {{ item.permanent_city.citymunDesc }}
                                </span>
                                <span v-if="item.permanent_barangay">
                                    {{ item.permanent_barangay.brgyDesc }}, 
                                </span>
                                <span v-if="item.per_street">{{ item.per_street }}</span>
                            </td>
                            <td v-if="show.children">
                                <span v-if="item.children">
                                    <div v-for="(child, ix) in item.children" :key="`el${ix}`">
                                        <span v-if="child.fullname">
                                            {{ child.fullname }},
                                        </span>
                                        
                                    </div>
                                </span>
                            </td>
                            <td v-if="show.civil_status">
                                <span v-if="item.civil_status">
                                    {{ item.civil_status }}
                                </span>
                            </td>
                            <td v-if="show.birthdate">
                                <span v-if="item.date_birth">
                                    {{ new Date(item.date_birth).toLocaleDateString() }}
                                </span>
                            </td>
                            <td v-if="show.gsis">
                                <span v-if="item.gsis">
                                    {{ item.gsis }}
                                </span>
                            </td>
                            <td v-if="show.pagibig">
                                <span v-if="item.pagibig">
                                    {{ item.pagibig }}
                                </span>
                            </td>
                            <td v-if="show.philhealth">
                                <span v-if="item.philhealth">
                                    {{ item.philhealth }}
                                </span>
                            </td>
                           
                            <td v-if="show.sss">
                                <span v-if="item.sss">
                                    {{ item.sss }}</span>
                                </td>
                            <td v-if="show.tin">{{ item.tin }}</td>
                            <td v-if="show.engagement">
                                <span v-if="item.engagement">{{ item.engagement.engagement_status }}</span>
                            </td>
                            <td v-if="show.agency_idno"><span v-if="item.agency_idno">{{ item.agency_idno }}</span></td>
                            <td v-if="show.eligibility">
                                <span v-if="item.eligibilities">
                                    <div v-for="(el, ix) in item.eligibilities" :key="`el${ix}`">
                                        <span v-if="el.career_exam">
                                            {{ el.career_exam }}
                                        </span>
                                        <span v-if="el.rating">
                                            - {{ el.rating }}, 
                                        </span>
                                    </div>
                                </span>
                            </td>
                            <td v-if="show.education">
                                <span v-if="item.educational_backgrounds">
                                    <div v-for="(ed, idx) in item.educational_backgrounds" :key="`ed${idx}`">
                                        <span v-if="ed.level">
                                            {{ ed.level }} 
                                        </span>
                                        <span v-if="ed.name_of_school">
                                            - {{ ed.name_of_school }}  
                                        </span>
                                        <span v-if="ed.degree">
                                            - {{ ed.degree }},
                                        </span>
                                    </div>
                                </span>
                            </td>
                            <td v-if="show.ld">
                                <span v-if="item.learning_developments">
                                    <div v-for="(ld, idx) in item.learning_developments" :key="`ld${idx}`">
                                        <span v-if="ld.title_learning_dev">
                                            {{ ld.title_learning_dev }} 
                                        </span> 
                                        <span v-if="ld.type_ld">
                                            - {{ ld.type_ld }}, 
                                        </span>
                                    </div>
                                </span>
                            </td>
                            <td v-if="show.voluntary">
                                <span v-if="item.voluntary_works">
                                    <div v-for="(voluntary, idx) in item.voluntary_works" :key="`voluntary${idx}`">
                                        <div v-if="voluntary.name_address_org">
                                            {{ voluntary.name_address_org }} 
                                        </div> 
                                       
                                    </div>
                                </span>
                            </td>
                            <td v-if="show.work_ex">
                                <span v-if="item.work_experiences">
                                    <div v-for="(work, idx) in item.work_experiences" :key="`work${idx}`">
                                        <div v-if="work.position_title">
                                            {{ work.position_title }} 
                                        </div> 
                                    </div>
                                </span>
                            </td>
                            
                        </tr>

                    </tbody>
                </table>

                <hr> -->


                <b-table
                    :data="data">
                
                    <b-table-column field="lname" label="Name" sortable v-slot="props">
                        {{ props.row.lname }}, {{ props.row.fname }} {{ props.row.mname }}
                    </b-table-column>
                    <b-table-column field="sex" label="Sex" sortable v-slot="props">
                        {{ props.row.sex }}
                    </b-table-column>
                    <b-table-column field="age" :visible="show.age" label="Age" sortable v-slot="props">
                        {{ props.row.age }}
                    </b-table-column>
                    <b-table-column :visible="show.height" field="height" label="Height" sortable v-slot="props">
                        {{ props.row.height }}
                    </b-table-column>
                    <b-table-column :visible="show.weight" field="weight" label="Weight" sortable v-slot="props">
                        {{ props.row.weight }}
                    </b-table-column>
                    <b-table-column :visible="show.blood" field="blood_type" label="Blood Type" sortable v-slot="props">
                        {{ props.row.blood_type }}
                    </b-table-column>
                    <b-table-column :visible="show.permanent_address" field="permanent_province.provDesc" label="Address" sortable v-slot="props">
                        <span v-if="props.row.permanent_province">
                            {{ props.row.permanent_province.provDesc }}
                        </span>
                        <span v-if="props.row.permanent_city">
                            , {{ props.row.permanent_city.citymunDesc }}
                        </span>
                        <span v-if="props.row.permanent_barangay">
                            {{ props.row.permanent_barangay.brgyDesc }}, 
                        </span>
                        <span v-if="props.row.per_street">{{ props.row.per_street }}</span>
                    </b-table-column>

                    <b-table-column field="children" label="Children" sortable v-slot="props" :visible="show.children">
                        <span v-if="props.row.children">
                            <div v-for="(child, ix) in props.row.children" :key="`el${ix}`">
                                <span v-if="child.fullname">
                                    {{ child.fullname }},
                                </span>
                                
                            </div>
                        </span>
                    </b-table-column>
                    <b-table-column field="civil_status" label="Civil Status" sortable v-slot="props" :visible="show.civil_status">
                        <span :visible="props.row.civil_status">
                            {{ props.row.civil_status }}
                        </span>
                    </b-table-column>
                    <b-table-column field="date_birth" label="Date Birth" sortable v-slot="props" :visible="show.birthdate">
                        <span v-if="props.row.date_birth">
                            {{ new Date(props.row.date_birth).toLocaleDateString() }}
                        </span>
                    </b-table-column>
                    <b-table-column field="gsis" label="GSIS" sortable v-slot="props" :visible="show.gsis">
                        <span v-if="props.row.gsis">
                            {{ props.row.gsis }}
                        </span>
                    </b-table-column>
                    <b-table-column field="pagibig" label="PAGIBIG" sortable v-slot="props" :visible="show.pagibig">
                        <span v-if="props.row.pagibig">
                            {{ props.row.pagibig }}
                        </span>
                    </b-table-column>
                    <b-table-column field="philhealth" label="Philhealth" sortable v-slot="props" :visible="show.philhealth">
                        <span v-if="props.row.philhealth">
                            {{ props.row.philhealth }}
                        </span>
                    </b-table-column>
                    
                    <b-table-column field="sss" label="SSS" sortable v-slot="props" :visible="show.sss">
                        <span v-if="props.row.sss">
                            {{ props.row.sss }}</span>
                        </b-table-column>
                    <b-table-column field="tin" label= "TIN" sortable v-slot="props" :visible="show.tin">
                        {{ props.row.tin }}
                    </b-table-column>
                    <b-table-column field="engagement" label="Engagement" sortable v-slot="props" :visible="show.engagement">
                        <span v-if="props.row.engagement">{{ props.row.engagement.engagement_status }}</span>
                    </b-table-column>
                    <b-table-column field="agency_idno" label= "Agency Id" sortable v-slot="props" :visible="show.agency_idno">
                        <span v-if="props.row.agency_idno">{{ props.row.agency_idno }}</span>
                    </b-table-column>
                    <b-table-column field="eligibilities" label= "Eligibilities" v-slot="props" :visible="show.eligibility">
                        <span v-if="props.row.eligibilities">
                            <div v-for="(el, ix) in props.row.eligibilities" :key="`el${ix}`">
                                <span v-if="el.career_exam">
                                    {{ el.career_exam }}
                                </span>
                                <span v-if="el.rating">
                                    - {{ el.rating }}, 
                                </span>
                            </div>
                        </span>
                    </b-table-column>
                    <b-table-column field="education" label="Education" v-slot="props" :visible="show.education">
                        <span v-if="props.row.educational_backgrounds">
                            <div v-for="(ed, idx) in props.row.educational_backgrounds" :key="`ed${idx}`">
                                <span v-if="ed.level">
                                    {{ ed.level }} 
                                </span>
                                <span v-if="ed.name_of_school">
                                    - {{ ed.name_of_school }}  
                                </span>
                                <span v-if="ed.degree">
                                    - {{ ed.degree }},
                                </span>
                            </div>
                        </span>
                    </b-table-column>
                    <b-table-column field="ld" label="Learning Development" v-slot="props" :visible="show.ld">
                        <span v-if="props.row.learning_developments">
                            <div v-for="(ld, idx) in props.row.learning_developments" :key="`ld${idx}`">
                                <span v-if="ld.title_learning_dev">
                                    {{ ld.title_learning_dev }} 
                                </span> 
                                <span v-if="ld.type_ld">
                                    - {{ ld.type_ld }}, 
                                </span>
                            </div>
                        </span>
                    </b-table-column>
                    <b-table-column field="voluntary" label="Voluntary" v-slot="props" :visible="show.voluntary">
                        <span v-if="props.row.voluntary_works">
                            <div v-for="(voluntary, idx) in props.row.voluntary_works" :key="`voluntary${idx}`">
                                <div v-if="voluntary.name_address_org">
                                    {{ voluntary.name_address_org }} 
                                </div> 
                                
                            </div>
                        </span>
                    </b-table-column>
                    <b-table-column field="work_ex" label= "Work Experience" v-slot="props" :visible="show.work_ex">
                        <span v-if="props.row.work_experiences">
                            <div v-for="(work, idx) in props.row.work_experiences" :key="`work${idx}`">
                                <div v-if="work.position_title">
                                    {{ work.position_title }} 
                                </div> 
                            </div>
                        </span>
                    </b-table-column>
                    
                </b-table>
            </div>

            <div class="mt-6 nprint"></div>

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
            reportTitle: 'REPORT',

            fields: {
                sex: 'all',
                range: 'all',
                engagement_status: [],
                civil_status: [],
                learning_dev: '',
                education: '',
                eligibility: '',
                work_ex: '',
                voluntary: ''

            },

            show:{
                age: false,
                height: false,
                weight: false,
                blood: false,
                permanent_address: false,
                children: false,
                civil_status: false,
                birthdate: false,
                gsis: false,
                pagibig: false,
                philhealth: false,
                sss: false,
                tin: false,
                engagement: false,
                agency_idno: false,
                eligibility: false,
                education: false,
                ld: false,
                voluntary: false,
                work_ex: false,
            },


           
            data: [],

            engagementStatus: [],
            sex: [],
            civilStatus: [],


            sort: 1,

        }
    },

    methods: {

        sortField(fieldName){
            if(this.sort === 1){
                this.sort = 0
                this.data.sort((a, b) => {
                    if (a[fieldName] < b[fieldName]) {
                        return -1;
                    }
                    if (a[fieldName] > b[fieldName]) {
                        return 1;
                    }
                    return 0;
                });
            }else{
                this.sort = 1
                this.data.sort((a, b) => {
                    if (a[fieldName] < b[fieldName]) {
                        return 1;
                    }
                    if (a[fieldName] > b[fieldName]) {
                        return -1;
                    }
                    return 0;
                });
            }
            
        },

        resetFilter(){
            this.fields = {
                sex: 'all',
                range: 'all',
                engagement_status: [],
                civil_status: [],
                learning_dev: '',
                education: '',
                eligibility: '',
                work_ex: '',
                voluntary: ''

            };

            this.show = {
                age: false,
                height: false,
                weight: false,
                blood: false,
                permanent_address: false,
                children: false,
                civil_status: false,
                birthdate: false,
                gsis: false,
                pagibig: false,
                philhealth: false,
                sss: false,
                tin: false,
                engagement: false,
                agency_idno: false,
                eligibility: false,
                education: false,
                ld: false,
                voluntary: false,
                work_ex: false,
            };

            this.loadReport()
        },

        loadReport(){
            const params = [
                `range=${this.fields.range}`,
                `sex=${this.fields.sex}`,
                `engagement=${this.fields.engagement_status}`,
                `education=${this.fields.education}`,
                `eligibility=${this.fields.eligibility}`,
                `learningdev=${this.fields.learning_dev}`,
                `civil=${this.fields.civil_status}`,
                `work=${this.fields.work_ex}`,
                `voluntary=${this.fields.voluntary}`,

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
        },

        loadCivilStatus(){
            axios.get('/load-civil-status').then(res=>{
                this.civilStatus = res.data
            })
        },

        calculateAge(dob) {
            // dob is the date of birth in the format 'YYYY-MM-DD' or a Date object
            let birthDate = new Date(dob);
            let today = new Date();

            let age = today.getFullYear() - birthDate.getFullYear();
            let monthDifference = today.getMonth() - birthDate.getMonth();
            let dayDifference = today.getDate() - birthDate.getDate();

            // Adjust age if the birth date hasn't occurred yet this year
            if (monthDifference < 0 || (monthDifference === 0 && dayDifference < 0)) {
                age--;
            }

            return age;
        }

    },

    mounted(){
        this.loadSex()
        this.loadEngagementStatus()
        this.loadCivilStatus()

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
        },

        // reportTitle(){
        //     if(this.fields.education){
        //         return 'EDUCATIONAL BACKGROUND REPORT'
        //     }else if(this.fields.eligibility){
        //         return 'ELIGIBILITY REPORT'
        //     }else if(this.fields.learning_dev){
        //         return 'LEARNING DEVELOPMENT REPORT'
        //     }else if(this.fields.work_ex){
        //         return 'WORK EXPERIENCE REPORT'
        //     }else if(this.fields.voluntary){
        //         return 'VOLUNTARY WORK REPORT'
        //     }else{
        //         return 'REPORT'
        //     }
        // }
            
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
