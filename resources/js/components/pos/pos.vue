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
                
                <div class="row animated fadeInUp">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="row">
                            
                            <div class="col-sm-12 col-md-4 col-xl-5 col-lg-5">
                                <div class="row">
                                    <div class="col-sm-12" style="font-size: 12px;">
                                        <div class="panel">
                                            <div class="panel-header">
                                                <span>Expense Insert</span>
                                                <a href="" class="btn btn-sm btn-info pull-right">Add Customer</a>
                                            </div>
                                            <div class="panel-content">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Qty</th>
                                                            <th>Unit</th>
                                                            <th>Total</th>
                                                            <th style="width:5px;">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="cartproduct in cartProducts" :key="cartproduct.id">
                                                            <td>{{cartproduct.product_name}}</td>
                                                            <td><input type="text" :value="cartproduct.product_qty" style="width:50px;">
                                                            <button class="btn btn-sm btn-info" @click="increment(cartproduct.id)" style="height: 20px;width: 20px;padding: 0px;">+</button>
                                                            <button class="btn btn-sm btn-danger" @click="decrement(cartproduct.id)" v-if="cartproduct.product_qty >= 2 " style="height: 20px;width: 20px;padding: 0px;">-</button>
                                                            
                                                            <button class="btn btn-sm btn-danger" v-else disabled style="height: 20px;width: 20px;padding: 0px;">-</button>

                                                            </td>
                                                            <td>{{cartproduct.product_price}}</td>
                                                            <td>{{cartproduct.sub_total}}</td>
                                                            <td @click="removeItem(cartproduct.id)" >
                                                                <i class="fa fa-times" style="color:red;    font-size: 25px;"></i>
                                                            </td>
                                                        </tr>
                                                    
                                                        </tbody>
                                                    </table>
                                                    
                                                    </div>
                                            </div>
                                            <div class="panel-footer">
                                                <ul class="list-group">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity: <strong> {{ totalQty }} </strong></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total: <strong>Tk {{ subTotal }}</strong></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Vat: <strong>3 %</strong></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Total: <strong>Tk {{  (subTotal*3/100 + subTotal).toFixed(2) }}</strong></li>
                                                    
                                                </ul>
                                                <br>
                                                <form @submit.prevent="orderDone">
                                                        
                                                        <div class="form-group">
                                                            <label for="email">Customer Phone Number</label>
                                                            <input type="text" class="form-control" v-model="customers" placeholder="customer phone" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email">Pay</label>
                                                            <input type="text" class="form-control" v-model="pay" placeholder="pay" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="due">Due</label>
                                                            <input type="text" class="form-control" placeholder="Due" v-model="due">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="text">Pay By</label>
                                                            <select class="form-control" v-model="payBy" required>
                                                                <option>Hand Cash</option>
                                                                <option>Cheaque</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-7 col-xl-7 col-lg-7">
                                <div class="row" >
                                    
                                        <div class="panel" style="min-height: 832px;">
                                            <div class="panel-header">
                                                <span>Products Sold</span>
                                            </div>
                                            <div class="panel-content ">
                                                <input type="text" class="form-control" v-model="serchProduct">
                                               
                                               <div class="col-3 row overflow-auto pull-left" style="max-height:400px;padding:0px;margin:0px;margin-top:3px;">
                                               
                                               <div id="list-example" class="list-group"  style="margin:0px;paddin:0px;min-width:142px;">
                                                    <a class="list-group-item list-group-item-action" href="#list-item-1" @click="allProducts()" >All Category</a>
                                                </div>
                                               <div id="list-example" class="list-group" v-for="cateogry in categories" :key="cateogry.id" style="margin:0px;paddin:0px;min-width:142px;">
                                                    <a class="list-group-item list-group-item-action" href="#list-item-1"  @click="subproduct(cateogry.id)">{{ cateogry.category_name}}</a>
                                                </div>


                                               </div>

                                               <div class="col-9 row overflow-auto pull-right" style="max-height:700px;">
                                                
                                                    <div class="card" style="width: 9.2rem; margin:3px;" v-for="product in filterSearch" :key="product.id">

                                                        <button style="border: 0px;padding: 0px;margin: 0px;" @click.prevent="addToCart(product.id)" v-if="product.product_quantity >= 1">
                                                            
                                                        <img class="card-img-top" :src="product.product_image"  alt="Card image cap">
                                                        <div class="card-body">
                                                            <p class="card-text">{{ product.product_name}}</p>
                                                            <span class="badge x-success" v-if="product.product_quantity >= 1 ">Available {{product.product_quantity}}</span>
                                                            <span class="badge x-danger" v-else>Stock Out</span>
                                                        </div>

                                                        </button>

                                                        <button style="border: 0px;padding: 0px;margin: 0px;" @click.prevent="emptyProduct" v-else>
                                                            
                                                        <img class="card-img-top" :src="product.product_image"  alt="Card image cap">
                                                        <div class="card-body">
                                                            <p class="card-text">{{ product.product_name}}</p>
                                                            <span class="badge x-success" v-if="product.product_quantity >= 1 ">Available {{product.product_quantity}}</span>
                                                            <span class="badge x-danger" v-else>Stock Out</span>
                                                        </div>

                                                        </button>


                                                    </div>
                                                    
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

        this.allEmployee();
        
        

    },

    data(){
        return{
            customers:'',
            pay:'',
            due:'',
            payBy:'',

            vat:3,

            allProduct:[],
            categories:[],
            cartProducts:[],
            serchProduct:'',
        }
    },

    created(){
        this.allProducts();
        this.cartProduct();
        axios.get('/api/category/')
            .then(({data})=> (this.categories = data))
            
        

    },

    methods:{

        allProducts()
        {
            axios.get('api/product/')
            .then(({data}) => (this.allProduct = data))
            .catch(
            console.log('error')
        )
        },
        
        subproduct(id){
            axios.get('/api/category/product/'+id)
            .then(({data})=> (this.allProduct = data))
            .catch(
                console.log('error')
            )
        },

        addToCart(id){
            axios.get('/api/addToCart/'+id)
            .then(({data})=> {
                if(data != "empty_product"){
                    Notification.cart_success(),
                    this.cartProduct();
                    
                }else{
                    Notification.emptyProduct();
                }
                      
            })
            .catch()
        },

        emptyProduct(){
            Notification.emptyProduct();
        },
        removeItem(id){
            axios.get('/api/remove/cart/'+id)
            .then(()=> {
                Notification.cart_delete(),
                this.cartProduct();
            })
            .catch()
        },

        increment(id){
            axios.get('/api/increment/cart/'+id)
            .then(()=> {
                Notification.cart_delete(),
                this.cartProduct();
            })
            .catch()
        },
        decrement(id){
            axios.get('/api/decrement/cart/'+id)
            .then(()=> {
                Notification.cart_delete(),
                this.cartProduct();
            })
            .catch()
        },

        cartProduct(){
            axios.get('api/Cart/product')
            .then(({data})=>(this.cartProducts = data))
            .catch()
        },

        orderDone()
        {
            let abckd = '1';
            let total = (this.subTotal*3/100 + this.subTotal).toFixed(2);
            var data = {user_id: User.id(), qty:this.totalQty, subtotal: this.subTotal, customers:this.customers, payby:this.payBy, pay:this.pay,due:this.due, vat: this.vat, Total: total}

            axios.post('/api/orderdone/',data)
            .then(()=>{
                Notification.success();
                this.cartProduct();
            })
            .catch()
        },

    },

    computed:{
        filterSearch(){
            return this.allProduct.filter(products=> {
                return products.product_name.toLowerCase().match(this.serchProduct)
        })
        },

        totalQty(){
            let sum = 0;
            for(let i = 0; i < this.cartProducts.length; i++){
                sum += (parseFloat(this.cartProducts[i].product_qty));
            }
            return sum;
        },

        subTotal(){
            let sum = 0;
            for(let i = 0; i < this.cartProducts.length; i++){
                sum += (parseFloat(this.cartProducts[i].product_qty) * parseFloat(this.cartProducts[i].product_price));
                
            }
            return sum;
        },

    }
}
</script>