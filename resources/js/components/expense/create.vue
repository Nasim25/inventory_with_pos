<template>
<div class="col-lg-6" style="margin-top:-72px">
    <h4 class="section-subtitle"><router-link to="/expense" class="btn btn-sm btn-success">All Expense </router-link></h4>
    <div class="card">
        
        <div class="card-header">
            Expense
        </div>
        <div class="card-body">
            <form @submit.prevent="expenseInsert" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Details</label>
                        <textarea v-model="form.details" class="form-control"></textarea>
                        <small class="text-danger" v-if="errors.details" > {{ errors.details[0] }}</small>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Amount</label>
                        <input type="number" class="form-control" v-model="form.amount" placeholder="Expense Amount" step=any>
                        <small class="text-danger" v-if="errors.amount" > {{ errors.amount[0] }}</small>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Responsible Person</label>
                        <select name="country"  class="form-control" v-model="form.emp_id">
                        
                          <option :value="employ.id"  v-for="employ in employee" :key="employ.id">{{ employ.emp_name}}</option>           
                            
                        </select>
                        <small class="text-danger" v-if="errors.amount" > {{ errors.amount[0] }}</small>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Expense Date</label>
                        <input type="date" class="form-control" v-model="form.expense_date" placeholder="Category Name">
                        <small class="text-danger" v-if="errors.expense_date" > {{ errors.expense_date[0] }}</small>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="inputEmail4"></label>
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>
                    
                </div>
                
                
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
        this.getEmployee();
    },

    data(){
        return{
            form:{
                details:   null,
                amount:   null,
                emp_id:   null,
                expense_date:   null,
            },
            employee:[],
            errors:{}
        }
    },

    methods:{
        
        getEmployee(){
            axios.get('api/employee-names')
            .then(({data})=> (this.employee = data))
            .catch()
        },
        expenseInsert(){
            axios.post('api/expense',this.form)
            .then(res => {
                this.$router.push('/expense')
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

