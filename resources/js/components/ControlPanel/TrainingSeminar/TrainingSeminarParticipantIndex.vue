<template>
    <div>
        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8-widescreen is-11-tablet">
                    <div class="box">
                        <div class="has-text-centered has-text-weight-bold is-size-5">
                            LIST OF PARTICIPANTS
                        </div>
                        <div class="has-text-centered has-text-weight-bold is-size-6 mb-1">
                            {{ propData.seminar_title }}
                        </div>

                        <div class="has-text-weight-bold">
                            FROM: {{ new Date(propData.date_from).toLocaleString() }}
                        </div>
                        <div class="has-text-weight-bold">
                            TO: {{ new Date(propData.date_to).toLocaleString() }}
                        </div>
                        <br>

                        <b-field label="Search">
                            <b-input type="text"
                                v-model="search.training" placeholder="Participant Name"
                                @keyup.native.enter="loadAsyncData"/>
                            <p class="control">
                                    <b-tooltip label="Search" type="is-success">
                                <b-button type="is-primary" icon-right="account-filter" @click="loadAsyncData"/>
                                    </b-tooltip>
                            </p>
                        </b-field>

                        <div class="buttons">
                            <b-button type="is-info" 
                                @click="printPreview"
                                label="PRINT" icon-right="printer"></b-button>
                        </div>

                        <b-table
                            :data="data"
                            :loading="loading"
                            paginated
                            backend-pagination
                            :total="total"
                            detailed
                            :per-page="perPage"
                            @page-change="onPageChange"
                            aria-next-label="Next page"
                            aria-previous-label="Previous page"
                            aria-page-label="Page"
                            aria-current-label="Current page"
                            backend-sorting
                            :default-sort-direction="defaultSortDirection"
                            @sort="onSort">

                            <b-table-column field="name" label="Name" v-slot="props">
                                {{ props.row.user.fname }} {{ props.row.user.mname }} {{ props.row.user.lname }}
                            </b-table-column>

                            <b-table-column field="date_register" label="Date Register" v-slot="props">
                                {{ new Date(props.row.date_register).toLocaleString() }}
                            </b-table-column>

                            <b-table-column field="approval_status" label="Event Title" v-slot="props">
                                <span class="pending" v-if="props.row.approval_status === 0">PENDING</span>
                                <span class="approved" v-else-if="props.row.approval_status === 1">APPROVED</span>
                                <span class="declined" v-else>DECLINED</span>
                            </b-table-column>


                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">
                                    <b-tooltip v-if="props.row.approval_status === 0" label="Approve" type="is-info">
                                        <b-button class="button is-small mr-1"
                                            icon-right="check-bold"
                                            @click="approveParticipant(props.row.training_participant_id)">
                                        </b-button>
                                    </b-tooltip>

                                </div>
                            </b-table-column>
                            
                            <!-- <template #detail="props">
                                <tr>
                                    <th>Time Logs</th>
                                    <th>Attendance Status</th>

                                </tr>
                                <tr v-for="(item,index) in props.row.attendances" :key="`log${index}`">
                                    <td>
                                        {{ new Date(item.datetime_scanned).toLocaleString() }}
                                    </td>
                                    <td>
                                        <span v-if="item.attendance_status === 'in_am'">IN AM</span>
                                        <span v-if="item.attendance_status === 'out_am'">OUT AM</span>
                                        <span v-if="item.attendance_status === 'in_pm'">IN PM</span>
                                        <span v-if="item.attendance_status === 'out_pm'">OUT PM</span>
                                    </td>
                                </tr>
                            </template> -->
                        </b-table>


                    </div>
                </div><!--close column-->
            </div>

        </div><!--section div-->

    </div>
</template>

<script>
export default {

    props: {
        propTrainingSeminarId: {
            type: Number,
            default: 0
        },

        propData: {
            type: Object,
            default: {}
        }
    },

    data(){
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'training_seminar_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 5,
            defaultSortDirection: 'asc',

            search: {
                name: '',
                training: '',
            },


        }
    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `name=${this.search.name}`,
                `perpage=${this.perPage}`,
                `trainingid=${this.propTrainingSeminarId}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-training-seminar-participants?${params}`)
                .then(({ data }) => {
                    this.data = [];
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }

                    this.total = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.data.push(item)
                    })
                    this.loading = false
                })
                .catch((error) => {
                    this.data = []
                    this.total = 0
                    this.loading = false
                    throw error
                })
        },
        /*
        * Handle page-change event
        */
        onPageChange(page) {
            this.page = page
            this.loadAsyncData()
        },

        onSort(field, order) {
            this.sortField = field
            this.sortOrder = order
            this.loadAsyncData()
        },

        setPerPage(){
            this.loadAsyncData()
        },

        openModal(){
            this.isModalCreate=true;
            this.fields = {};
            this.errors = {};


        },

        //alert box ask for deletion
        approveParticipant(dataId) {
            this.$buefy.dialog.confirm({
                title: 'Approve?',
                type: 'is-info',
                message: 'Are you sure you want to approve this participant?',
                cancelText: 'No',
                confirmText: 'Yes',
                onConfirm: () => this.approveSubmit(dataId)
            });
        },
        //execute delete after confirming
        approveSubmit(dataId) {
            axios.post('/training-seminar-participant-approve/' + dataId).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },


        printPreview(){
            window.location = '/report-training-attendances/' + this.propTrainingSeminarId
        }
    
    },

    mounted() {

        this.loadAsyncData();
    }

}
</script>

<style scoped>
    .pending{
        font-weight: bold;
        color: #3b60af;
    }
    .approved{
        font-weight: bold;
        color: #639c42;
    }
    .declined{
        font-weight: bold;
        color: #af4a31;
    }
</style>
