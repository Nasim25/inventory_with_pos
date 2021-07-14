<template>
<div>
    <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Stocks</a></li>
                    </ul>
                </div>
    </div>

    <div class="row animated fadeInRight">
                <!--BORDERED-->
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <input type="text" class="pull-right" placeholder="serch" v-model="serchProduct" >
                            
                            <br>
                            <br>
                            <div class="table-responsive" style="border-top: 2px solid #ececec;">
                                <table class="table table-striped table-hover table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="product in filterSearch" :key="product.id">
                                        <td><img :src="product.product_image" id="product_image" style="height:33px;"></td>
                                        <td>{{ product.product_name}}</td>
                                        <td>{{ product.product_code}}</td>
                                        <td>{{ product.selling_price}}</td>
                                        <td>{{ product.product_quantity}}</td>
                                        
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
            allProduct:[],
            serchProduct:'',
        }
    },

    created(){
        axios.get('api/product/')
        .then(({data}) => (this.allProduct = data))
        .catch()

    },

    computed:{
        filterSearch(){
            return this.allProduct.filter(products=> {
                return products.product_name.toLowerCase().match(this.serchProduct)
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
