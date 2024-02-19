<template>
    <div>
        <div class="print-form debug">

            <div class="columns m-2 nprint">
                <div class="column nprint">
                    <b-field label="Select designation" label-position="on-border"
                        expanded>
                        <b-select v-model="search.designation" expanded
                            @input="loadReporyBySex">
                            <option value="">ALL</option>
                            <option value="FACULTY">FACULTY</option>
                            <option value="STAFF">STAFF</option>
                        </b-select>
                    </b-field>
                </div>
                <div class="column">
                    <div class="buttons">
                        <b-button icon-right="printer" label="PRINT PREVIEW">
                        </b-button>
                    </div>
                </div>
            </div>

            <div class="columns">

            </div>
            
            <div class="has-text-weight-bold has-text-centered">REPORT BY SEX</div>
        </div>


    </div>
</template>

<script>

export default{
    data(){
        return {
            search: {
                designation: '',
                data: [],
            }
        }
    },

    methods: {
        loadReporyBySex(){
            const params = [
                
                `designation=${this.search.designation}`,
       
            ].join('&')

            
            axios.get(`/report-load-report-by-sex?${params}`).then(res=>{
                this.data = res.data
            })
        }
    },

    mounted(){

    }
}
</script>