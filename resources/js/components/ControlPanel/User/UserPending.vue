<template>
    <div>
        
        <div class="is-flex mb-2" style="font-size: 20px; font-weight: bold;">USER LIST</div>
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


        <div class="buttons mt-3">
            <b-button @click="openModal" icon-left="account" class="is-success is-outlined is-small has-text-weight-bold">NEW USER</b-button>
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

            <b-table-column field="role" label="ROLE" v-slot="props">
                {{ props.row.role }}
            </b-table-column>

            <b-table-column field="status" label="STATUS" v-slot="props">
                <span v-if="props.row.is_partime === 1">PARTIME</span>
                <span v-else>FULLTIME</span>

            </b-table-column>

            <b-table-column label="ACTION" v-slot="props">
                <div class="is-flex">
                    <b-tooltip label="Edit" type="is-warning">
                        <b-button class="button is-small mr-1" tag="a" 
                            icon-right="pencil" 
                            @click="getData(props.row.user_id)"></b-button>
                    </b-tooltip>
                    <!-- <b-tooltip label="Delete" type="is-danger">
                        <b-button class="button is-small mr-1" icon-right="delete" @click="confirmDelete(props.row.user_id)"></b-button>
                    </b-tooltip> -->
                    <b-tooltip label="Reset Password" type="is-info">
                        <b-button class="button is-small mr-1" icon-right="lock" @click="openModalResetPassword(props.row.user_id)"></b-button>
                    </b-tooltip>
                    <b-tooltip label="More options..." type="is-info">
                            <b-dropdown aria-role="list">
                            <template #trigger="{ active }">
                                <b-button
                                    label=""
                                    type="is-info"
                                    size="is-small"
                                    :icon-right="active ? 'menu-up' : 'menu-down'" />
                            </template>
                            <b-dropdown-item aria-role="listitem" @click="approve(props.row.user_id)">Activate</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem"
                                @click="setArchived(props.row.user_id, 1)">Archived</b-dropdown-item>
                        </b-dropdown>
                    </b-tooltip>
                </div>
            </b-table-column>

            <template #detail="props">
                <tr>
                    <th>Engagement</th>
                    <th>Designation</th>
                    <th>Institute</th>
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
                        <span v-if="props.row.institute">
                            {{ props.row.institute }}
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



        <!--modal create-->
        <b-modal v-model="isModalCreate" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="submit">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">USER INFORMATION</p>
                        <button
                            type="button"
                            class="delete"
                            @click="isModalCreate = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Username" label-position="on-border"
                                             :type="this.errors.username ? 'is-danger':''"
                                             :message="this.errors.username ? this.errors.username[0] : ''">
                                        <b-input v-model="fields.username"
                                                 placeholder="Username" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Last Name" label-position="on-border"
                                             :type="this.errors.lname ? 'is-danger':''"
                                             :message="this.errors.lname ? this.errors.lname[0] : ''">
                                        <b-input v-model="fields.lname"
                                                 placeholder="Last Name" required>
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="First Name" label-position="on-border"
                                             :type="this.errors.fname ? 'is-danger':''"
                                             :message="this.errors.fname ? this.errors.fname[0] : ''">
                                        <b-input v-model="fields.fname"
                                                 placeholder="First Name" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Middle Name" label-position="on-border"
                                             :type="this.errors.mname ? 'is-danger':''"
                                             :message="this.errors.mname ? this.errors.mname[0] : ''">
                                        <b-input v-model="fields.mname"
                                                 placeholder="Middle Name">
                                        </b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Email" label-position="on-border"
                                             :type="errors.email ? 'is-danger':''"
                                             :message="errors.email ? errors.email[0] : ''">
                                        <b-input type="email" v-model="fields.email"
                                                 placeholder="Email" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Contact No" label-position="on-border"
                                             :type="errors.contact_no ? 'is-danger':''"
                                             :message="errors.contact_no ? errors.contact_no[0] : ''">
                                        <b-input type="number" v-model="fields.contact_no"
                                                 placeholder="Contact No" required>
                                        </b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Sex" label-position="on-border" expanded
                                             :type="errors.sex ? 'is-danger':''"
                                             :message="errors.sex ? errors.sex[0] : ''"
                                            >
                                        <b-select v-model="fields.sex" expanded>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>
                            <div class="columns" v-if="global_id < 1">
                                <div class="column">
                                    <b-field label="Password" label-position="on-border"
                                             :type="errors.password ? 'is-danger':''"
                                             :message="errors.password ? errors.password[0] : ''">
                                        <b-input type="password" password-reveal v-model="fields.password"
                                                 placeholder="Password" required>
                                        </b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Confirm Password" label-position="on-border"
                                             :type="errors.password_confirmation ? 'is-danger':''"
                                             :message="errors.password_confirmation ? errors.password_confirmation[0] : ''">
                                        <b-input type="password" password-reveal v-model="fields.password_confirmation"
                                                 placeholder="Confirm Password" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="ENGAGEMENT STATUS" expanded
                                        label-position="on-border"
                                        :type="errors.engagement_status_id ? 'is-danger':''"
                                        :message="errors.engagement_status_id ? errors.engagement_status_id[0] : ''">
                                        <b-select v-model="fields.engagement_status_id" expanded
                                            placeholder="Engagement Status">
                                            <option v-for="(item, index) in engagementStatuses"
                                                :key="`es${index}`" 
                                                :value="item.engagement_status_id">{{ item.engagement_status }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="STATUS" expanded
                                        label-position="on-border"
                                        :type="errors.is_partime ? 'is-danger':''"
                                        :message="errors.is_partime ? errors.is_partime[0] : ''">
                                        <b-select v-model="fields.is_partime" expanded
                                            placeholder="Status">
                                           <option :value="0">FULLTIME</option>
                                           <option :value="1">PARTIME</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Designation" label-position="on-border" expanded
                                             :type="errors.designation ? 'is-danger':''"
                                             :message="errors.designation ? errors.designation[0] : ''">
                                        <b-select v-model="fields.designation" expanded>
                                            <option value="FACULTY">FACULTY</option>
                                            <option value="STAFF">STAFF</option>
                                        </b-select>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Institute" label-position="on-border" expanded
                                             :type="errors.institute ? 'is-danger':''"
                                             :message="errors.institute ? errors.institute[0] : ''">
                                        <b-select v-model="fields.institute" expanded>
                                            <option :value="item.code" v-for="(item, index) in institutes" :key="`ins${index}`">
                                                {{ item.code }} - {{ item.institute}}
                                            </option>
                                        </b-select>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Role" label-position="on-border" expanded
                                             :type="errors.role ? 'is-danger':''"
                                             :message="errors.role ? errors.role[0] : ''">
                                        <b-select v-model="fields.role" expanded>
                                            <option value="administrator">ADMINISTRATOR</option>
                                            <option value="employee">EMPLOYEE</option>
                                            <option value="point_person">POINT-PERSON</option>
                                            <option value="record_officer">RECORD OFFICER</option>
                                            <option value="training_officer">TRAINING/DEVELOPMENT OFFICER</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>
                        </div>
                    </section>

                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="isModalCreate=false"/>
                        <button
                            :class="btnClass"
                            label="Save"
                            type="is-success">SAVE</button>
                    </footer>

                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->




        <!--modal reset password-->
        <b-modal v-model="modalResetPassword" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="resetPassword">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Change Password</p>
                        <button
                            type="button"
                            class="delete"
                            @click="modalResetPassword = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Password" label-position="on-border"
                                             :type="this.errors.password ? 'is-danger':''"
                                             :message="this.errors.password ? this.errors.password[0] : ''">
                                        <b-input type="password" v-model="fields.password" password-reveal
                                                 placeholder="Password" required>
                                        </b-input>
                                    </b-field>
                                    <b-field label="Confirm Password" label-position="on-border"
                                             :type="this.errors.password_confirmation ? 'is-danger':''"
                                             :message="this.errors.password_confirmation ? this.errors.password_confirmation[0] : ''">
                                        <b-input type="password" v-model="fields.password_confirmation"
                                                 password-reveal
                                                 placeholder="Confirm Password" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="modalResetPassword=false"/>
                        <button
                            :class="btnClass"
                            label="Save"
                            type="is-success">SAVE</button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->







        <!--modal reset password-->
        <b-modal v-model="modalOtherInformation" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="submitOtherInfo">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Other Info</p>
                        <button
                            type="button"
                            class="delete"
                            @click="modalOtherInformation = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <div class="columns">
                                <div class="column">

                                    <div class="columns">
                                        <div class="column">
                                            <b-field label="Special Skill & Hobbies" label-position="on-border"
                                                     :type="this.errorOthers.skill_hobbies ? 'is-danger':''"
                                                     :message="this.errorOthers.skill_hobbies ? this.errorOthers.skill_hobbies[0] : ''">
                                                <b-select v-model="fieldsOther.skill_hobbies"
                                                          placeholder="Special Skill & Hobbies"
                                                          expanded>
                                                    <option v-for="(i, ix) in specializations" :key="ix"
                                                            :value="i.specialization">
                                                        {{ i.specialization }}
                                                    </option>
                                                </b-select>
                                            </b-field>
                                        </div>
                                    </div>

                                    <div class="columns">
                                        <div class="column">
                                            <b-field label="Non-academic Distinction" label-position="on-border">
                                                <b-input type="text" v-model="fieldsOther.non_academic_distinction"
                                                          placeholder="Non-academic Distinction">
                                                </b-input>
                                            </b-field>
                                        </div>
                                        <div class="column">
                                            <b-field label="Member of Association" label-position="on-border">
                                                <b-input type="text" v-model="fieldsOther.member_association"
                                                         placeholder="Member of Association">
                                                </b-input>
                                            </b-field>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="modalOtherInformation=false"/>
                        <button
                            :class="btnClass"
                            label="Save"
                            type="is-success">Save Other Info</button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->


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
                institute: '',
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
            institutes: [],

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
            axios.get(`/get-users-pending?${params}`)
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

        loadInstitutes(level){
            axios.get('/load-institutes').then(res=>{
                this.institutes = res.data
            })
        },

    },

    mounted() {
        this.loadAsyncData();
       // this.loadProvince();
        this.loadEngagementStatuses();
        this.loadInstitutes()
    }

}
</script>


<style scoped>


</style>
