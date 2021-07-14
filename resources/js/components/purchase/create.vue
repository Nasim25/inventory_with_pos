<template>
<div>
    <div class="content-header">
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-columns" aria-hidden="true"></i><a href="#">Purchase</a></li>
            </ul>
        </div>
    </div>

    <div class="row animated fadeInUp">
        <div class="col-sm-12">
            <div class="card">
            <div class="card-header">
                Purchase
            </div>
            <div class="card-body">
              <form @submit.prevent="purchaseDone">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Invoice No.</label>
                    <input type="text" class="form-control" v-model="invoice_number" placeholder="Invoice No." required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Supplier</label>
                    <select id="inputState" class="form-control" v-model="supplier_id" required>
                      <option :value="supplier.id"  v-for="supplier in suppliers" :key="supplier.id">{{ supplier.name}}</option>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Date</label>
                    <input type="date" class="form-control" v-model="date"  required>
                  </div>

                  <div class="form-group col-md-6" style="padding: 26px;">
                    
                    <button type="button" class="btn btn-primary col-6" @click="openMyModel">
                      Products
                    </button>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-lg-8">
                  
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Unit Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th style="width:1%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <tr v-for="vproduct in vertualProduct" :key="vproduct.id">
                                        <td>{{ vproduct.id }}</td>
                                        <td>{{ vproduct.product_name }}</td>
                                        <td>{{ vproduct.unit_price }}</td>
                                        <td>{{ vproduct.qty }}</td>
                                        <td>{{ vproduct.total }}</td>
                                        <td @click="deleteProduct(vproduct.id)" >
                                          <i class="fa fa-trash" style="color: red; font-size:15px;"></i>
                                          
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="inputEmail4">Other</label>
                      <input type="number" class="form-control" v-model="other" step="any" required>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail4">G. Total</label>
                      <input type="number" class="form-control" v-model="subTotal"  disabled>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail4">Paid</label>
                      <input type="number" class="form-control" v-model="paid" step="any" required>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail4">Due</label>
                      <input type="text" class="form-control" v-model="dueAmount" disabled>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail4">Payment</label>
                      <select id="inputState" class="form-control" v-model="payment_method" required>
                      <option value="Hand Cash">Hand Cash</option>
                      <option value="Bank">Bank</option>
                    </select>
                    </div>

                  </div>
                </div>

                <hr>
                <div class="form-group">
                      
                      <input type="button" class="btn btn-danger" @click="clearAll" value="Clear">
                      <input type="submit" class="btn btn-success">
                    </div>

              </form>
            </div>
            </div>
        </div>
        
  
                
    </div>


<!-- Modal -->
<div v-if="myModel">
    <transition name="model">
     <div class="modal-mask">
      <div class="modal-wrapper">
       <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
          <button type="button" class="close" @click="myModel=false"><span aria-hidden="true">&times;</span></button>
          
         </div>
         <div class="modal-body">
           <form @submit.prevent="addNewProduct">
            <div class="form-group">
            <label>Select Product</label>
              <select class="form-control" v-model="product_id" required>
                    <option :value="product.id" v-for="product in products" :key="product.id">{{ product.product_name }}</option>
              </select>
            </div>
            <div class="form-group">
            <label>Unit Price</label>
            <input type="number" class="form-control" v-model="unit_price" step="any" required />
            </div>
            <div class="form-group">
            <label>Quantity</label>
            <input type="number" class="form-control" v-model="qty" step="any" required />
            </div>

            <br />
            <div align="center">
            <!-- <button type="button" class="btn btn-success btn-xs" @click="myModel=false">Close</button> -->
            <input type="button" class="btn btn-danger btn-xs" @click="myModel=false" value="Close"/>
            <input type="submit" class="btn btn-success btn-xs" value="Add To Cart" />
            </div>
           </form>
         </div>
        </div>
       </div>
      </div>
     </div>
    </transition>
   </div>
   <!-- model -->


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
        product_id:'',
        unit_price:'',
        qty:'',

        invoice_number:'',
        date:'',
        payment_method:'',
        supplier_id:'',
        other:0,
        paid:0,

        myModel:false,
        suppliers:[],
        products:[],
        vertualProduct:[],
      }
    },

    created(){
      this.getProduct();
      axios.get('/api/supplier/')
          .then(({data})=> (this.suppliers = data))
      
      axios.get('/api/product/')
          .then(({data})=> (this.products = data))
    },

    methods:{

      openMyModel(){
        this.product_id ='',
        this.unit_price ='',
        this.qty ='',
        this.myModel = true;
      },
      addNewProduct(){
        let product_id = this.product_id;
        let unit_price = this.unit_price;
        let qty = this.qty;
        let data = {product_id:product_id,unit_price:unit_price,qty:qty}
        axios.post('/api/saveproduct/',data)
          .then(({data})=>{
            if(data !="empty_product"){
              this.getProduct();
              this.myModel = false;
              Notification.success();

            }else{
              Notification.subproducterror();
              this.getProduct();
              
            }
            
            })
            .catch(()=>{
              
            })

        
      },

      getProduct()
      {
          axios.get('/api/getvertualproduct/')
            .then(({data})=>(this.vertualProduct = data))
            .catch()
      },

      clearAll(){
          axios.get('/api/clearproduct/')
            .then(()=>{
                this.getProduct();
            })
            .catch()
      },

      purchaseDone(){
       
        let data = {user_id: User.id(),payment_method: this.payment_method,supplier_id: this.supplier_id,invoice_number: this.invoice_number,date:this.date,other: this.other,paid: this.paid,gtotal: this.subTotal,due:this.dueAmount};

        axios.post('/api/purchase/store/',data)
          .then(()=>{
              this.getProduct();
              Notification.success();
              
          })
          .catch()

      },

      deleteProduct(id){
        axios.get('/api/vproduct/delete/'+id)
            .then(()=>{
              this.getProduct();
              Notification.cart_delete();
            })
            .catch()
      }
    },
    
    computed:{
      
      subTotal(){
            let sum = 0;
            for(let i = 0; i < this.vertualProduct.length; i++){
                sum += (parseFloat(this.vertualProduct[i].qty) * parseFloat(this.vertualProduct[i].unit_price));
                
            }
            if(this.other>0){
              let sto = (parseFloat(sum) + parseFloat(this.other));

              return parseFloat(sto).toFixed(2);
            }else{
              return parseFloat(sum).toFixed(2);         }
            
            
        },

        dueAmount(){
          let sum = 0;
          if(this.paid > 0){
            sum = (parseFloat(this.subTotal) - parseFloat(this.paid));
            
          }else{
            sum = this.subTotal;
          }

          return parseFloat(sum).toFixed(2);
        
      },

    },


}
</script>
<style scoped>
   .modal-mask {
     position: fixed;
     z-index: 9998;
     top: -137px;
     left: 0;
     width: 100%;
     height: 100%;
     background-color: rgba(0, 0, 0, .5);
     display: table;
     transition: opacity .3s ease;
   }

   .modal-wrapper {
     display: table-cell;
     vertical-align: middle;
   }
</style>