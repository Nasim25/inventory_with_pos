<template>
<div>
    <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Suppliers</a></li>
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
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Phone</th>
                                        <th>Shop Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="supplier in filterScrch" :key="supplier.id">
                                        <td>{{ supplier.name}}</td>
                                        <td><img :src="supplier.photo" id="supplier_image" /></td>
                                        <td>{{ supplier.phone}}</td>
                                        <td>{{ supplier.company_name}}</td>
                                        <td>{{ supplier.email}}</td>
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

        this.allSuppliers()
    },
    data(){
        return{
            suppliers:[],
            supplier_serch:'',
        }
    },

    computed:{
        filterScrch(){
            return this.suppliers.filter(supplier=>{
                return supplier.name.toLowerCase().match(this.supplier_serch)
            })
        }
    },
    methods:{
        
        allSuppliers(){
            axios.get('/api/supplier/')
            .then(({data})=> (this.suppliers = data))
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
