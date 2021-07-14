<template>
<div style="margin-top:-72px">
    <h4 class="section-subtitle"><router-link to="/employee" class="btn btn-sm btn-success">All Employee </router-link></h4>
    <div class="card">
        
        <div class="card-header">
            Pay Salary
        </div>
        <div class="card-body">
            <form @submit.prevent="salaryPay" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Employee Name</label>
                        <input type="text" class="form-control" v-model="form.emp_name" placeholder="Employee Name">
                        <small class="text-danger" v-if="errors.emp_name" > {{ errors.emp_name[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Employee ID</label>
                        <input type="text" class="form-control" v-model="form.emp_id" placeholder="Enter Employee NID">
                        <small class="text-danger" v-if="errors.emp_id" > {{ errors.emp_id[0] }}</small>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Salary</label>
                        <input type="number" class="form-control" v-model="form.emp_salary" placeholder="Enter Employee Salary">
                        <small class="text-danger" v-if="errors.emp_salary" > {{ errors.emp_salary[0] }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Salary of Month</label>
                        <select name="country"  class="form-control" v-model="form.salary_month">
                        
                          <option value="January">January</option>           
                          <option value="February">February</option>           
                          <option value="March">March</option>           
                          <option value="April">April</option>           
                          <option value="May">May</option>           
                          <option value="June">June</option>           
                          <option value="July">July</option>           
                          <option value="August">August</option>           
                          <option value="September">September</option>           
                          <option value="October">October</option>           
                          <option value="November">November</option>           
                          <option value="December">December</option>           
                            
                        </select>
                        <small class="text-danger" v-if="errors.salary_month" > {{ errors.salary_month[0] }}</small>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Date of Salary</label>
                        <input type="date" class="form-control" v-model="form.salary_date" >
                        <small class="text-danger" v-if="errors.salary_date" > {{ errors.salary_date[0] }}</small>
                    </div>
                    
                </div>
                
                <button type="submit" class="form-control btn btn-primary">Pay Now</button>
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
                emp_salary: null,
                emp_id: null,
                salary_month: null,
                salary_date: null,
            },
            errors:{}
        }
    },

    created(){
        let id = this.$route.params.id
        axios.get('/api/employee/'+id)
            .then(({data})=>(this.form = data))
            .catch()
    },
    methods:{
        

        salaryPay(){
            let id = this.$route.params.id
            axios.post('/api/salary/paid/'+id,this.form)
            .then(res => {
                // this.$router.push('/employee')
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