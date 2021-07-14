<template>
<div>
    <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Customers</a></li>
                        
                    </ul>
                </div>
    </div>

    <div class="row animated fadeInRight">
                <!--BORDERED-->
                <div class="col-sm-12">
                   
                    <div class="panel">
                        <div class="panel-content">
                            <input type="text" class="pull-right" placeholder="serch" v-model="serchCustomers" >
                            
                            <br>
                            <br>
                            <div class="table-responsive" style="border-top: 2px solid #ececec;">
                                <table class="table table-striped table-hover table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Previus Due</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="customer in filterSearch" :key="customer.id">
                                        
                                        <td>{{ customer.customer_name}}</td>
                                        <td>{{ customer.customer_phone}}</td>
                                        <td>{{ customer.customer_email}}</td>
                                        <td>{{ customer.customer_previus_due}}</td>
                                        
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <button class="btn btn-transparent"><i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-transparent"><i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-transparent"><i class="fa fa-times text-danger"></i>
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
        if(!User.loggedIn()){
            this.$router.push({name: '/'});
        }
    },
    data(){
        return{
            customers:[],
            serchCustomers:'',
        }
    },

    created(){
        axios.get('api/customer')
            .then(({data})=>(this.customers = data))

    },

    computed:{
        filterSearch(){
            return this.customers.filter(customer=> {
                return customer.customer_phone.match(this.serchCustomers)
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
