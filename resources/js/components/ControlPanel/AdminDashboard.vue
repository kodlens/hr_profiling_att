<template>
    <div>
        <div class="welcome">
            <div class="welcome-content">
                <img src="/img/hr.png" />


                <div class="has-text-weight-bold mt-5 has-text-centered is-size-4">WELCOME TO HUMAN RESOURCE PROFILING & ATTENDANCE SYSTEM</div>
            </div>
           
        </div>
        
  

        <!-- <div class="section">
            <div class="buttons">
                <b-button type="is-info" @click="sendSMS" label="Send"></b-button>
            </div>
        </div> -->


    </div>
</template>

<script>
export default {
	data(){
		return{
            info: {},

		}
	},

	methods:{

	},

    mounted() {
        
    }
}
</script>

<style scoped>
    .welcome{
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
        margin-top: -35px;
    }

    .welcome-content{
        display: flex;
        flex-direction: column;
    }
</style>
