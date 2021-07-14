<template>
<div>
    <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Expense</a></li>
                    </ul>
                </div>
    </div>

    <div class="row animated fadeInRight">
                <!--BORDERED-->
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <input type="text" class="pull-right" placeholder="serch" v-model="expense_serch" >
                            <br>
                            <br>
                            <div class="table-responsive" style="border-top: 2px solid #ececec;">
                                <table class="table table-striped table-hover table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Expense Name</th>
                                        <th>Responsible Person</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="expense in filterScrch" :key="expense.id">
                                        <td>{{ expense.id}}</td>
                                        <td>{{ expense.expense_date}}</td>
                                        <td>{{ expense.amount}}</td>
                                        <td>{{ expense.details}}</td>
                                        <td>{{ expense.emp_name}}</td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <button class="btn btn-transparent"><i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-transparent"><i class="fa fa-pencil"></i>
                                                </button>
                                                <button @click="deleteSupp(supplier.id)" class="btn btn-transparent"><i class="fa fa-times text-danger"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

        this.allExpense()
    },
    data(){
        return{
            expense:[],
            expense_serch:'',
        }
    },

    computed:{
        filterScrch(){
            return this.expense.filter(expenses=>{
                return expenses.details.toLowerCase().match(this.expense_serch)
            })
        }
    },
    methods:{
        
        allExpense(){
            axios.get('/api/expense/')
            .then(({data})=> (this.expense = data))
            .catch(
                console.log('error')
            )
        },

        deleteSupp(id){
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

                axios.delete('api/supplier/'+id)
                .then(()=>{
                    this.allSuppliers();
                })
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
        }

    }
}
</script>

<style scoped>
.panel{
    border-top: 3px solid #189279;
}
#supplier_image{
    width:35;
    height: 35px;
}
</style>
