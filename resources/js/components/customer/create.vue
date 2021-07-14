<template>
<div style="margin-top:-72px">
    <h4 class="section-subtitle"><router-link to="/customer-list" class="btn btn-sm btn-success">All Customer </router-link></h4>
    <div class="card">
        
        <div class="card-header">
            Add Customer
        </div>
        <div class="card-body">
            <form @submit.prevent="customerInsert" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Full Name</label>
                        <input type="text" class="form-control" v-model="form.customer_name" placeholder="Customer Name">
                        <small class="text-danger" v-if="errors.customer_name" > {{ errors.customer_name[0] }}</small>
                    </div>
                   
                    
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Phone Number</label>
                        <input type="number" class="form-control" v-model="form.customer_phone" placeholder="Enter Phone Number">
                        <small class="text-danger" v-if="errors.customer_phone" > {{ errors.customer_phone[0] }}</small>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Date of Birth</label>
                        <input type="date" class="form-control" v-model="form.date_of_birth" >
                        <small class="text-danger" v-if="errors.date_of_birth" > {{ errors.date_of_birth[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Email Address</label>
                        <input type="email" class="form-control" v-model="form.customer_email" placeholder="Enter Email Address">
                        <small class="text-danger" v-if="errors.customer_email" > {{ errors.customer_email[0] }}</small>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Address</label>
                        <input type="text" class="form-control" v-model="form.customer_address" placeholder="Enter Customer Address">
                        <small class="text-danger" v-if="errors.customer_address" > {{ errors.customer_address[0] }}</small>
                    </div>
                    
                    
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>  
</template>

<script>
export default {
    created()
    {
        if(!User.loggedIn())
        {
            this.$router.push({name: '/'})
        }
    },

    data(){
        return{
            form:{
                customer_name:   null,
                customer_phone:  null,
                customer_email:  null,
                customer_address:  null,
                date_of_birth:      null,
            },
            errors:{}
        }
    },

    methods:{
        
        customerInsert(){
            axios.post('api/customer',this.form)
            .then(res => {
                this.$router.push('/customer-list')
                Notification.success();

                })
            
            .catch(error => {
                this.errors = error.response.data.errors
                }
            )
        }
    }
}
</script>

