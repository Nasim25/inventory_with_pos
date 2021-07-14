<template>
<div>
    <div class="content-header">
                <!-- leftside content header -->
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Products</a></li>
                    </ul>
                </div>
    </div>
    
        <div class="form-group col-md-4">
                  
            <input type="date" class="form-control" v-model="startDate"  placeholder="Expense Amount" step=any>
                        
        </div>
        <div class="form-group col-md-4">
                  
            <input type="date" class="form-control" v-model="endDate"  placeholder="Expense Amount" step=any>
                        
        </div>
        <div class="form-group col-md-4">
                  
            <select name="country"  class="form-control"  @change="selectProduct">
                        
                <option :value="product.id" v-for="product in allProduct" :key="product.id" >{{ product.product_name}}</option>           
                            
            </select>
                        
        </div>
    

    <div class="row animated fadeInRight">
                <!--BORDERED-->
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="col-12 text-center" style="line-height:7px">
                                <h3>Product Purchase Report</h3>
                                
                                <p>Date : {{startDate}} - {{endDate}}</p>
                            </div>
                            <span class="badge x-success">Purchase Value =Tk {{totalValue}} </span>
                            <span class="badge x-o x-warning">Purchase Qty = {{totalqty}} </span>
                            <input type="text" class="pull-right" placeholder="serch"  >
                            
                            <br>
                            <br>
                            <div class="table-responsive" style="border-top: 2px solid #ececec;">
                                <table class="table table-striped table-hover table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice No.</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Selling P.</th>
                                        <th>Buying P.</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="product in getProduct" :key="product.id">
                                            <td>{{ product.date }}</td>
                                            <td>{{ product.invoice_number }}</td>
                                            <td>{{ product.product_name }}</td>
                                            <td>{{ product.qty }}</td>
                                            <td>{{ product.selling_price }}</td>
                                            <td>{{ product.unit_price }}</td>
                                            <td>{{ product.total }}</td>
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
            
            startDate: '',
            endDate: '',
            selectProductId: '',

            allProduct:[],
            getProduct:[],
            
        }
    },

    created(){

        axios.get('/api/productget/for/purchase/')
        .then(({data}) => (this.allProduct = data))
        .catch()


    },

    methods:{
        selectProduct(event)
        {   
            var data = {id:event.target.value,startDate: this.startDate,endDate: this.endDate}
            axios.post('/api/getpurchaseproductbyid/',data)
                        .then(({data})=>(this.getProduct = data))
                        .catch()
        }
    },
    computed:{
        totalValue(){

            let sum = 0;
            for(let i = 0; i < this.getProduct.length; i++){
                if(this.getProduct[i].qty > 0)
                {
                    sum += (parseFloat(this.getProduct[i].unit_price) * parseFloat(this.getProduct[i].qty));
                }
                
            }
            return sum;
        },
        totalqty(){

            let sum = 0;
            for(let i = 0; i < this.getProduct.length; i++){
                
                    sum += (parseFloat(this.getProduct[i].qty));
                
                
            }
            return sum;
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
