<template>

    
    <div class="col-sm-12" id="employee_list">
        <h4 class="section-subtitle"><router-link to="/store-employee" class="btn btn-sm btn-success">Add Employee </router-link></h4>

                    <div class="panel">
                        <div class="panel-content">
                            <input type="text" class="pull-right" placeholder="serch" v-model="searchTerm" >
                            
                            <br>
                            <br>
                            <div class="table-responsive" style="border-top: 2px solid #ececec;">
                                <table class="table table-striped table-hover table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Phone</th>
                                        <th>Salary</th>
                                        <th>Joining date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="employee in filterserch" :key="employee.id">
                                        <td>{{ employee.emp_name }}</td>
                                        <td><img :src="employee.emp_image" id="emp_image" ></td>
                                        <td>{{ employee.emp_phone }}</td>
                                        <td>{{ employee.emp_salary }}</td>
                                        <td>{{ employee.emp_joiningDate }}</td>
                                        <td>
                                            <router-link :to="{name:'pay-salary' ,params:{id:employee.id}}" class="btn btn-sm btn-info">Pay Salray</router-link>
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

    </div>
</template>

<script>
export default {
    created(){
        if(!User.loggedIn())
        {
            this.$router.push({name: '/'})
        }

        this.allEmployee();

    },
    
    data(){
        return{
            employees:[],
            searchTerm:'',
        }
    },

    computed:{
        filterserch(){
            return this.employees.filter(employee=> {
                return employee.emp_name.toLowerCase().match(this.searchTerm)
        })
        }
    },
    methods:{
        allEmployee(){
            axios.get('api/employee/')
            .then(({data})=> (this.employees = data))
            .catch()
        },

        deleteEmp(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {

                axios.delete('api/employee/'+id)
                .then(()=>{
                    this.allEmployee();
                })
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
        }
    },
}
</script>

<style scoped>
#emp_image{
    width:35;
    height: 35px;
}
#employee_list{
    margin-top: -74px;
}
</style>