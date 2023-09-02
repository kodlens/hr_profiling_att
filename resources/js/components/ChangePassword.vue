<template>
    <div>
        <div class="columns">
            <div class="column is-6">

                <div class="box">
                    <div class="column">
                        <b-field label="Old Password" label-position="on-border"
                            :type="this.errors.old_password ? 'is-danger':''"
                            :message="this.errors.old_password ? this.errors.old_password[0] : ''">
                            <b-input type="password" v-model="fields.old_password" password-reveal
                                placeholder="Password" required>
                            </b-input>
                        </b-field>
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
            
                    <div class="buttons">
                        <b-button
                            type="is-primary" 
                            icon-left="lock-open-variant-outline" @click="resetPassword">
                            Reset Password
                        </b-button>
                    </div>

                </div> <!-- box end-->

            </div>
        </div>
        
    </div>
</template>

<script>

export default{
    data(){
        return {
            fields:{},
            errors: {},
        }
    },

    methods: {
        resetPassword(){
            axios.post('/reset-password', this.fields).then(res=>{

                if(res.data.status === 'changed'){
                    this.$buefy.dialog.alert({
                        title: 'PASSWORD CHANGED',
                        type: 'is-success',
                        message: 'Password changed successfully.',
                        confirmText: 'OK',
                        onConfirm: () => {
                            this.modalResetPassword = false;
                        }
                    });
                }

            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }

            })
        },
    },

    mounted(){

    }
}
</script>