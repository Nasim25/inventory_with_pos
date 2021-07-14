<template>
<div>
    <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Sales Details</a></li>
                    </ul>
                </div>
    </div>

    <div class="row animated fadeInUp">
                <!--BASIC-->
                <div class="col-sm-12 col-md-6">
                    <h4 class="section-subtitle">Customer Info</h4>
                    <div class="panel">
                        <div class="panel-content">
                            
                            <div class="table-responsive">

                                <ul class="list-group">
                                   <li class=" d-flex justify-content-between align-items-center">Customer Name <strong> {{ salesdetails.customer_name }} </strong></li>
                                   <li class=" d-flex justify-content-between align-items-center">Customer Phone <strong> {{ salesdetails.customer_phone }} </strong></li>
                                   <li class=" d-flex justify-content-between align-items-center">Customer Address <strong> {{ salesdetails.customer_address }} </strong></li>
                                   <li class=" d-flex justify-content-between align-items-center">Sales Date <strong> {{ salesdetails.sell_date }} </strong></li>
                                   <li class=" d-flex justify-content-between align-items-center">Pay Through <strong> {{ salesdetails.payby }} </strong></li>
                                                    
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <!--HORIZONTAL-->
                <div class="col-sm-12 col-md-6">
                    <h4 class="section-subtitle">Sales Details</h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <ul class="list-group">
                                   <li class=" d-flex justify-content-between align-items-center">Sub Total <strong> {{ salesdetails.subtotal }} </strong></li>
                                   <li class=" d-flex justify-content-between align-items-center">Vat <strong> {{ salesdetails.vat }} </strong></li>
                                   <li class=" d-flex justify-content-between align-items-center">Total <strong> {{ salesdetails.total }} </strong></li>
                                   <li class=" d-flex justify-content-between align-items-center">Pay Amount <strong> {{ salesdetails.pay }} </strong></li>
                                   <li class=" d-flex justify-content-between align-items-center">Due Amount <strong> {{ salesdetails.due }} </strong></li>
                                                    
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <!--STRIPE-->
                <div class="col-md-12">
                    <h4 class="section-subtitle">Product Information</h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Image</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="products in salesdetailsall" :key="products.id">
                                    <td>{{products.product_name}}</td>
                                    <td>{{products.product_code}}</td>
                                    <td><img :src="'/'+products.product_image" id="product_image" style="height:33px;"></td>
                                    <td>{{products.product_qty}}</td>
                                    <td>{{products.product_price}}</td>
                                    <td>{{products.sub_total}}</td>
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
    },

    data(){
        return{
            salesdetails:[],
            salesdetailsall:[],
        }
    },

    created(){
        let id = this.$route.params.id
        axios.get('/api/sales/details/'+id)
        .then(({data})=>(this.salesdetails = data))
        .catch()

        axios.get('/api/sales/details/all/'+id)
        .then(({data})=>(this.salesdetailsall = data))
        .catch()

    },
    

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
