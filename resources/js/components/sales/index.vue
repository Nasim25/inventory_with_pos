<template>
<div>
    <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Sales List</a></li>
                    </ul>
                </div>
    </div>

    <div class="row animated fadeInRight">
                <!--BORDERED-->
                <div class="col-sm-12">
                    
                   
                    <div class="panel">
                        <div class="panel-content">
                            <input type="text" class="pull-right" placeholder="serch" v-model="supplier_serch" >
                            <br>
                            <br>
                            <div class="table-responsive" style="border-top: 2px solid #ececec;">
                                <table class="table table-striped table-hover table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Customer No.</th>
                                        <th>Total Amount</th>
                                        <th>Pay</th>
                                        <th>Due</th>
                                        <th>PayBy</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="allSale in sales" :key="allSale.id">
                                        <td>{{ allSale.customer_phone}}</td>
                                        <td>{{ allSale.total}}</td>
                                        <td>{{ allSale.pay}}</td>
                                        <td>{{ allSale.due}}</td>
                                        <td>{{ allSale.payby}}</td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <router-link :to="{name:'salesdetails', params:{id:allSale.id}}" class="btn btn-sm btn-success">View
                                                </router-link>
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

        this.allSales()
    },
    data(){
        return{
            sales:[],
            supplier_serch:'',
        }
    },

    computed:{
        filterScrch(){
            return this.sales.filter(sale=>{
                return sale.sell_date.toLowerCase().match(this.supplier_serch)
            })
        }
    },
    methods:{
        
        allSales(){
            axios.get('/api/sales/list/')
            .then(({data})=> (this.sales = data))
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
