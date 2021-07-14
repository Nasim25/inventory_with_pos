<template>
    <div class="box col-lg-10 col-md-12 col-sm-12 col-xs-12" >
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <center><h1 style="color: #036df1;">BAITS POS</h1></center>
                    <form @submit.prevent="login">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" v-model="form.email" id="email" placeholder="Email">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <small class="text-danger" v-if="errors.email" > {{ errors.email[0] }}</small>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" id="password" v-model="form.password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                            <small class="text-danger" v-if="errors.password" > {{ errors.password[0] }}</small>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="remember-me" value="option1" checked>
                                <label class="check" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Sign In">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
</template>
<script>
export default {

    created(){
        if(User.loggedIn()){
            this.$router.push({name: 'home'})
        }
    },
    data()
    {
        return {
            form:{
                email: null,
                password: null,
            },
            errors:{}
        }
    },

    methods:{
        login(){
            axios.post('api/auth/login',this.form)
            .then(res => {
                User.responseAfterLogin(res)

                Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
                })

                this.$router.push({ name: 'home' })
                })
            
            .catch(error => {
                this.errors = error.response.data.errors
                
                Toast.fire({
                icon: 'error',
                title: 'Incorrect Email & Password'
                })

            }
            )
        }
    }
}
</script>

<style scoped>

</style>