<template>
    <div>
        
        <div class="is-flex mb-2" style="font-size: 20px; font-weight: bold;">USER LIST</div>
        <hr>

        <div class="level">
            <div class="level-left">
                <b-field label="Page">
                    <b-select v-model="perPage" @input="setPerPage">
                        <option value="10">10 per page</option>
                        <option value="20">20 per page</option>
                        <option value="30">30 per page</option>
                    </b-select>
                </b-field>
            </div>

            <div class="level-right">
                <div class="level-item">
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
            </div>
        </div>


        <b-table
            :data="data"
            :loading="loading"
            paginated
            backend-pagination
            :total="total"
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

            <b-table-column label="ACTION" v-slot="props">
                <div class="is-flex">
                    
                    <b-tooltip label="More options..." type="is-info">
                            <b-dropdown aria-role="list">
                            <template #trigger="{ active }">
                                <b-button
                                    label=""
                                    type="is-info"
                                    size="is-small"
                                    :icon-right="active ? 'menu-up' : 'menu-down'" />
                            </template>


                            <!-- <b-dropdown-item aria-role="listitem">Reset Password</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem"></b-dropdown-item> -->
                            <b-dropdown-item aria-role="listitem"
                                @click="setArchived(props.row.user_id)">Activate</b-dropdown-item>
                        </b-dropdown>
                    </b-tooltip>

                    

                    
                </div>
            </b-table-column>
        </b-table>


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
            },

          

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
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
                `lname=${this.search.lname}`,
                `archive=1`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/admin/get-users?${params}`)
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

        

        setArchived(id, value){
            axios.post('/admin/users-set-archive/'+id+'/0').then(res=>{
                if(res.data.status == 0){
                    this.$buefy.toast.open({
                        message: 'User successfully activated.',
                        type: 'is-success'
                    })
                }
                this.loadAsyncData()

            })
        }

    },

    mounted() {
        this.loadAsyncData();
        this.loadProvince();
    }

}
</script>


<style scoped>


</style>
