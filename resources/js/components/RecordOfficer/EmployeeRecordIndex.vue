<template>
    <div>

        <div class="columns is-centered mt-5">
            <div class="column is-8">
                
                <div class="box">
                    <div class="is-flex mb-2" style="font-size: 20px; font-weight: bold;">EMPLOYEE LIST</div>
                    <hr>
                    <div class="columns">
                        <div class="column">
                            <b-field label="Page">
                                <b-select v-model="perPage" @input="setPerPage">
                                    <option value="10">10 per page</option>
                                    <option value="20">20 per page</option>
                                    <option value="30">30 per page</option>
                                </b-select>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="Search">
                                <b-input type="text"
                                            v-model="search.lname" placeholder="Search Lastname"
                                            @keyup.native.enter="loadAsyncData"/>
                                <p class="control">
                                        <b-tooltip label="Search" type="is-success">
                                    <b-button type="is-primary" icon-right="magnify" @click="loadAsyncData"/>
                                        </b-tooltip>
                                </p>
                            </b-field>
                        </div>

                        <div class="column">
                            <b-field label="ENGAGEMENT STATUS">
                                <b-select v-model="search.engagement"
                                    @input="loadAsyncData"
                                    placeholder="Engagement Status">
                                    <option value="">ALL</option>
                                    <option v-for="(item, index) in engagementStatuses"
                                        :key="`es${index}`" 
                                        :value="item.engagement_status_id">{{ item.engagement_status }}</option>
                                </b-select>
                            </b-field>
                        </div>
                    </div>



                    <b-table
                        :data="data"
                        :loading="loading"
                        paginated
                        backend-pagination
                        :total="total"
                        detailed
                        :pagination-rounded="false"
                        :per-page="perPage"
                        @page-change="onPageChange"
                        aria-next-label="Next page"
                        aria-previous-label="Previous page"
                        aria-page-label="Page"
                        aria-current-label="Current page"
                        backend-sorting
                        :default-sort-direction="defaultSortDirection"
                        @sort="onSort">

                        <b-table-column field="user_id" label="ID" sortable v-slot="props">
                            {{ props.row.user_id }}
                        </b-table-column>

                        <b-table-column field="username" label="USERNAME" sortable v-slot="props">
                            {{ props.row.username }}
                        </b-table-column>

                        <b-table-column field="lname" label="NAME" sortable v-slot="props">
                            {{ props.row.lname }}, {{ props.row.fname }} {{ props.row.mname }}
                        </b-table-column>

                        <b-table-column field="sex" label="SEX" v-slot="props">
                            {{ props.row.sex }}
                        </b-table-column>

                        <b-table-column field="email" label="EMAIL" v-slot="props">
                            {{ props.row.email }}
                        </b-table-column>

                        <!-- <b-table-column field="role" label="ROLE" v-slot="props">
                            {{ props.row.role }}
                        </b-table-column> -->

                        <b-table-column field="status" label="STATUS" v-slot="props">
                            <span v-if="props.row.is_partime === 1">PARTIME</span>
                            <span v-else>FULLTIME</span>

                        </b-table-column>

                        <b-table-column label="ACTION" v-slot="props">
                            <div class="is-flex">
                               
                                <!-- <b-tooltip label="Delete" type="is-danger">
                                    <b-button class="button is-small mr-1" icon-right="delete" @click="confirmDelete(props.row.user_id)"></b-button>
                                </b-tooltip> -->
                              
                                <b-tooltip label="More options..." type="is-info">
                                        <b-dropdown aria-role="list">
                                        <template #trigger="{ active }">
                                            <b-button
                                                label=""
                                                type="is-info"
                                                size="is-small"
                                                :icon-right="active ? 'menu-up' : 'menu-down'" />
                                        </template>
                                     
                                        <b-dropdown-item aria-role="listitem"
                                            tag="a"
                                            :href="`/record-officer/print-pds/${props.row.user_id}`">Show PDS</b-dropdown-item>
                                        <b-dropdown-item aria-role="listitem"
                                            tag="a"
                                            :href="`/record-officer/files-manager/${props.row.user_id}`">Files</b-dropdown-item>
                                      
                                    </b-dropdown>
                                </b-tooltip>
                            </div>
                        </b-table-column>

                        <template #detail="props">
                            <tr>
                                <th>Engagement</th>
                                <th>Designation</th>
                                <th>Approve</th>
                            </tr>
                            <tr>
                                <td>
                                    <span v-if="props.row.engagement">
                                        {{ props.row.engagement.engagement_status }}
                                    </span>
                                </td>
                                <td>
                                    <span v-if="props.row.designation">
                                        {{ props.row.designation }}
                                    </span>
                                </td>
                                <td>
                                    <span v-if="props.row.is_approve > 0">
                                        YES
                                    </span>
                                    <span v-else>
                                        NO
                                    </span>
                                </td>
                            </tr>
                        </template>
                    </b-table>

                </div> <!-- box-->
                
            </div> <!-- col-->
        </div> <!--div cols-->
        
        


    </div>
</template>

<script>
export default{

    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'user_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 20,
            defaultSortDirection: 'asc',


            global_id : 0,

            search: {
                lname: '',
                engagement: ''
            },

            isModalCreate: false,
            modalResetPassword: false,
            modalOtherInformation: false,

            fields: {
                username: '',
                lname: '', fname: '', mname: '',
                password: '', password_confirmation : '',
                sex : '', role: '',  cid_sub_role: '',
                email : '', contact_no : '',
                province: '', city: '', barangay: '', street: ''
            },

            fieldsOther: {},
            errors: {},
            errorOthers: {},

        

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

            provinces: [],
            cities: [],
            barangays: [],

            specializations: [],
            cid_sub_roles: [],
            engagementStatuses: [],


        }

    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `lname=${this.search.lname}`,
                `engagement=${this.search.engagement}`,
                `archive=0`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/record-officer/get-employees?${params}`)
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

        loadProvince: function(){
            axios.get('/load-provinces').then(res=>{
                this.provinces = res.data;
            })
        },

        loadCity: function(){
            axios.get('/load-cities?prov=' + this.fields.res_province).then(res=>{
                this.cities = res.data;
            })
        },

        loadBarangay: function(){
            axios.get('/load-barangays?prov=' + this.fields.res_province + '&city_code='+this.fields.res_city).then(res=>{
                this.barangays = res.data;
            })
        },

        submit: function(){
            if(this.fields.role != 'CID'){
                this.fields.cid_sub_role = '';
            }


            if(this.global_id > 0){
                //update
                axios.put('/users/'+this.global_id, this.fields).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: 'UPDATED!',
                            message: 'Successfully updated.',
                            type: 'is-success',
                            onConfirm: () => {
                                this.loadAsyncData();
                                this.clearFields();
                                this.global_id = 0;
                                this.isModalCreate = false;
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }else{
                //INSERT HERE
                axios.post('/users', this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: 'SAVED!',
                            message: 'Successfully saved.',
                            type: 'is-success',
                            confirmText: 'OK',
                            onConfirm: () => {
                                this.isModalCreate = false;
                                this.loadAsyncData();
                                this.clearFields();
                                this.global_id = 0;
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                });
            }
        },


        //alert box ask for deletion
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this data?',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/users/' + delete_id).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

        clearFields(){
            this.fields = {
                username: '',
                lname: '', fname: '', mname: '',
                password: '', password_confirmation : '',
                sex : '', role: '',  email : '', contact_no : '',
                province: '', city: '', barangay: '', street: ''
            };
        },


        //update code here
        getData: async function(data_id){
            this.clearFields();
            this.global_id = data_id;
            this.isModalCreate = true;
            let tempData 
            //nested axios for getting the address 1 by 1 or request by request
            await axios.get('/users/'+data_id).then(res=>{
                this.fields = res.data;
                tempData = res.data;
            });

            // await axios.get('/load-cities?prov=' + this.fields.res_province).then(res=>{
            //         //load barangay
            //     this.cities = res.data;   
            // });

            // await axios.get('/load-barangays?prov=' + this.fields.res_province + '&city_code='+this.fields.res_city).then(res=>{
            //     this.barangays = res.data;
            //     this.fields = tempData
            // });
        },

       


        //CHANGE PASSWORD
        openModalResetPassword(dataId){
            this.modalResetPassword = true;
            this.fields = {};
            this.errors = {};
            this.global_id = dataId;
        },
        resetPassword(){
            axios.post('/user-reset-password/' + this.global_id, this.fields).then(res=>{

                if(res.data.status === 'changed'){
                    this.$buefy.dialog.alert({
                        title: 'PASSWORD CHANGED',
                        type: 'is-success',
                        message: 'Password changed successfully.',
                        confirmText: 'OK',
                        onConfirm: () => {
                            this.modalResetPassword = false;
                            this.fields = {};
                            this.errors = {};
                            this.loadAsyncData()
                        }
                    });
                }

            }).catch(err=>{
                this.errors = err.response.data.errors;
            })
        },

        setArchived(id, value){
            axios.post('/users-set-archive/'+id+'/' + value).then(res=>{
                if(res.data.status == 1){
                    this.$buefy.toast.open({
                        message: 'Archived successfully',
                        type: 'is-success'
                    })
                }
                this.loadAsyncData()
            })
        },

        approve(id){
            this.loading = true
            axios.post('/user-set-approve/'+id).then(res=>{
                if(res.data.status === 'approved'){
                this.loading = false

                    this.$buefy.toast.open({
                        message: 'Activated successfully',
                        type: 'is-success'
                    })
                }
                this.loadAsyncData()
            })
        },

          
        loadEngagementStatuses(level){
            axios.get('/load-engagement-status').then(res=>{
                this.engagementStatuses = res.data
            })
        },

    },

    mounted() {
        this.loadAsyncData();
       // this.loadProvince();
        this.loadEngagementStatuses();
    }

}
</script>


<style scoped>


</style>
