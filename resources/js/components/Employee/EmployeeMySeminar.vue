<template>
    <div>
        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8-widescreen is-11-tablet">
                    <div class="box">
                        <div class="is-flex is-justify-content-center mb-2" style="font-size: 20px; font-weight: bold;">Employee Seminars</div>

                        <div class="level">
                            <div class="level-left">
                                <b-field label="Page">
                                    <b-select v-model="perPage" @input="setPerPage">
                                        <option value="5">5 per page</option>
                                        <option value="10">10 per page</option>
                                        <option value="15">15 per page</option>
                                        <option value="20">20 per page</option>
                                        <option value="25">25 per page</option>
                                        <option value="30">30 per page</option>
                                    </b-select>
                                    <b-select v-model="sortOrder" @input="loadAsyncData">
                                        <option value="asc">ASC</option>
                                        <option value="desc">DESC</option>

                                    </b-select>
                                </b-field>
                            </div>

                            <div class="level-right">
                                <div class="level-item">
                                    <b-field label="Search">
                                        <b-input type="text"
                                                 v-model="search.training" placeholder="Training/Seminar"
                                                 @keyup.native.enter="loadAsyncData"/>
                                        <p class="control">
                                             <b-tooltip label="Search" type="is-success">
                                            <b-button type="is-primary" icon-right="account-filter" @click="loadAsyncData"/>
                                             </b-tooltip>
                                        </p>
                                    </b-field>
                                </div>
                            </div>
                        </div>


                        <b-table
                            :data="data"
                            :loading="loading"
                            paginated
                            backend-pagination
                            :total="total"
                            :per-page="perPage"
                            @page-change="onPageChange"
                            aria-next-label="Next page"
                            aria-previous-label="Previous page"
                            aria-page-label="Page"
                            aria-current-label="Current page"
                            backend-sorting
                            :default-sort-direction="defaultSortDirection"
                            @sort="onSort">

                            <b-table-column field="training_participant_id" label="ID" v-slot="props">
                                {{ props.row.training_participant_id }}
                            </b-table-column>

                            <b-table-column field="date_register" label="Date & Time" v-slot="props">
                                {{ new Date(props.row.date_register).toLocaleString() }}
                            </b-table-column>

                            <b-table-column field="training_seminar" label="Event Title" v-slot="props">
                                {{ props.row.training_seminar.seminar_title }}
                            </b-table-column>

                            <b-table-column field="seminar_date" label="Training/Seminar Date" v-slot="props">
                                {{ new Date(props.row.training_seminar.date_from).toLocaleString() }}
                                -
                                {{ new Date(props.row.training_seminar.date_to).toLocaleString() }}

                            </b-table-column>

                            <b-table-column field="approval_status" label="Event Title" v-slot="props">
                                <span class="pending" v-if="props.row.approval_status === 0">PENDING</span>
                                <span class="approved" v-else-if="props.row.approval_status === 1">APPROVED</span>
                                <span class="declined" v-else>DECLINED</span>
                            </b-table-column>


                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">
                                    <b-tooltip v-if="props.row.approval_status === 0" label="Remove" type="is-info">
                                        <b-button class="button is-small mr-1"
                                            icon-right="delete"
                                            @click="removeMe(props.row.training_participant_id)">
                                        </b-button>
                                    </b-tooltip>

                                    <b-tooltip v-if="props.row.approval_status === 1" label="QR Code" type="is-info">
                                        <b-button class="button is-small mr-1"
                                            icon-right="qrcode"
                                            @click="openQrModal(props.row)">
                                        </b-button>
                                    </b-tooltip>

                                </div>
                            </b-table-column>

                        </b-table>


                    </div>
                </div><!--close column-->
            </div>

        </div><!--section div-->



        
        <!--modal qr-->
        <b-modal v-model="modalQRForm" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>


            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">QR Code</p>
                    <button
                        type="button"
                        class="delete"
                        @click="modalQRForm = false"/>
                </header>
                <section class="modal-card-body">
                    <div class="">
                        <div class="columns">
                            <qrcode v-if="qrCode"
                                class="qr-code"
                                :value="qrCode" 
                                :options="{ width: 200 }"></qrcode>

                        </div>

                    </div> <!-- div class-->
                </section>
                <footer class="modal-card-foot">
                    <button
                        @click="modalQRForm = false"
                        class="button is-primary">OK</button>
                </footer>
            </div>
        </b-modal>
        <!--close modal-->



    </div>
</template>

<script>
export default {

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
                training: '',
            },

            modalQRForm: false,
            qrCode: '',

        }
    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `training=${this.search.training}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/employee/get-my-seminars?${params}`)
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
        removeMe(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'Remove?',
                type: 'is-danger',
                message: 'Are you sure you want to remove your request for participation?',
                cancelText: 'No',
                confirmText: 'Yes',
                onConfirm: () => this.removeSubmit(delete_id)
            });
        },
        //execute delete after confirming
        removeSubmit(delete_id) {
            axios.post('/employee/my-seminars-remove-me/' + delete_id).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },
        

        openQrModal(row){
            console.log(row);
            this.modalQRForm = true
            this.qrCode = `{"user_id":"${row.user_id}","training_seminar_id":"${row.training_seminar_id}"}`
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

    .qr-code{
        display: block;
        margin: auto;
    }
</style>
