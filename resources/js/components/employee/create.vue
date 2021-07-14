<template>
<div style="margin-top:-72px">
    <h4 class="section-subtitle"><router-link to="/employee" class="btn btn-sm btn-success">All Employee </router-link></h4>
    <div class="card">
        
        <div class="card-header">
            Add Employee
        </div>
        <div class="card-body">
            <form @submit.prevent="employeeInsert" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Full Name</label>
                        <input type="text" class="form-control" v-model="form.emp_name" placeholder="Employee Name">
                        <small class="text-danger" v-if="errors.emp_name" > {{ errors.emp_name[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Employee ID</label>
                        <input type="text" class="form-control" v-model="form.emp_id" placeholder="Enter Employee NID">
                        <small class="text-danger" v-if="errors.emp_id" > {{ errors.emp_id[0] }}</small>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Phone Number</label>
                        <input type="number" class="form-control" v-model="form.emp_phone" placeholder="Enter Phone Number">
                        <small class="text-danger" v-if="errors.emp_phone" > {{ errors.emp_phone[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Date of Birth</label>
                        <input type="date" class="form-control" v-model="form.emp_dateofbirth" >
                        <small class="text-danger" v-if="errors.emp_dateofbirth" > {{ errors.emp_dateofbirth[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Email Address</label>
                        <input type="email" class="form-control" v-model="form.emp_email" placeholder="Enter Email Address">
                        <small class="text-danger" v-if="errors.emp_email" > {{ errors.emp_email[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Joining Date</label>
                        <input type="date" class="form-control" v-model="form.emp_joiningDate" >
                        <small class="text-danger" v-if="errors.emp_joiningDate" > {{ errors.emp_joiningDate[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Employee Address</label>
                        <input type="text" class="form-control" v-model="form.emp_address" placeholder="Enter Employee Address">
                        <small class="text-danger" v-if="errors.emp_address" > {{ errors.emp_address[0] }}</small>
                    </div>
                    
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Salary</label>
                        <input type="number" class="form-control" v-model="form.emp_salary" placeholder="Enter Employee Salary">
                        <small class="text-danger" v-if="errors.emp_salary" > {{ errors.emp_salary[0] }}</small>
                    </div>
                    
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Employee Image</label>
                        <input type="file" class="form-control"  @change="onFileSelected">
                        <small class="text-danger" v-if="errors.emp_image" > {{ errors.emp_image[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        
                        <img :src="form.emp_image" style="height: 105px;width: 105px;">
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
                emp_name:   null,
                emp_phone:  null,
                emp_email:  null,
                emp_salary: null,
                emp_dateofbirth:  null,
                emp_address:      null,
                emp_id: null,
                emp_image: null,
            },
            errors:{}
        }
    },

    methods:{
        onFileSelected(event){
            
            let file = event.target.files[0];
            if(file.size > 1048770)
            {
                Notification.image_validation();
            }else{
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.emp_image = event.target.result
                };
                reader.readAsDataURL(file);
                
            }
        },

        employeeInsert(){
            axios.post('api/employee',this.form)
            .then(res => {
                this.$router.push('/employee')
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

