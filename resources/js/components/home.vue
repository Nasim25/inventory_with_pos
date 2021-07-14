<template>
    <div>
        <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-12 col-lg-12">
                        <div class="row">
                            
                            <div class="col-sm-12 col-lg-12">
                                <div class="col-sm-12 col-lg-3 col-xl-3">
                                    <div class="panel widgetbox wbox-2 bg-scale-0">
                                        <a href="#">
                                            <div class="panel-content">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <span class="icon fa fa-shopping-cart color-darker-2"></span>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <h4 class="subtitle color-darker-1">Today Sell Amount</h4>
                                                        <h1 class="title color-primary"> 154.609</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-3 col-xl-3">
                                    <div class="panel widgetbox wbox-2 bg-scale-0">
                                        <a href="#">
                                            <div class="panel-content">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <span class="icon fa fa-money color-darker-2"></span>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <h4 class="subtitle color-darker-1">Today Income</h4>
                                                        <h1 class="title color-primary"> 105</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-3 col-xl-3">
                                    <div class="panel widgetbox wbox-2 bg-scale-0">
                                        <a href="#">
                                            <div class="panel-content">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <span class="icon fa fa-sort-amount-asc color-darker-2"></span>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <h4 class="subtitle color-darker-1">Today Due</h4>
                                                        <h1 class="title color-primary"> 105</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-3 col-xl-3">
                                    <div class="panel widgetbox wbox-2 bg-scale-0">
                                        <a href="#">
                                            <div class="panel-content">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <span class="icon fa fa-file color-darker-2"></span>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <h4 class="subtitle color-darker-1">Today Expense</h4>
                                                        <h1 class="title color-primary"> 105</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="col-sm-12 col-lg-12 col-xl-12">
                                    <div class="panel panelcolor">
                                        <div class="panel-content">
                                            <h4 class="text-danger pull-left">Out Of Stock Products</h4>
                                            <!-- <input type="text" class="pull-right" placeholder="serch" v-model="serchProduct" > -->
                                            
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
                                                        <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="product in stockoutproducts" :key="product.id">
                                                        <td><img :src="product.product_image" id="product_image" style="height:33px;"></td>
                                                        <td>{{ product.product_name}}</td>
                                                        <td>{{ product.product_code}}</td>
                                                        <td>{{ product.selling_price}}</td>
                                                        <td>{{ product.product_quantity}}</td>
                                                        <td><span class="badge x-danger">Stock Out</span></td>
                                                    </tr>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
    },

    data(){
        return{
            stockoutproducts:'',
        }
    },

    created(){
        axios.get('api/stock/out/products')
                .then(({data})=>(this.stockoutproducts = data))
                .catch()
    }
}
</script>

<style scoped>
.panelcolor{
    border-top: 3px solid #189279;
}
#supplier_image{
    width:35;
    height: 35px;
}



</style>