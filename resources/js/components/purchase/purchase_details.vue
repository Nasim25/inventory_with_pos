<template>
<div>
    <div class="content-header">
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-columns" aria-hidden="true"></i><a href="#">Purchase Details</a></li>
            </ul>
        </div>
    </div>

    <div class="row animated fadeInUp">
        <div class="col-sm-12">
            <div class="card">
            <div class="card-header">
                Purchase Details
            </div>
            <div class="card-body">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Invoice No.</label>
                    <input type="text" class="form-control" :value="allpurchase.invoice_number"   disabled>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Supplier</label>
                    <input type="text" class="form-control" :value="allpurchase.name"   disabled>
                  </div>


                  <div class="form-group col-md-4">
                    <label for="inputPassword4">Date</label>
                    <input type="text" class="form-control" :value="allpurchase.date"   disabled>
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
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <tr v-for="vproduct in purchaseDetails" :key="vproduct.id">
                                        <td>{{ vproduct.id }}</td>
                                        <td>{{ vproduct.product_name }}</td>
                                        <td>{{ vproduct.unit_price }}</td>
                                        <td>{{ vproduct.qty }}</td>
                                        <td>{{ vproduct.total }}</td>
                                        
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
                      <input type="text" class="form-control"  :value="allpurchase.other" disabled>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail4">G. Total</label>
                      <input type="number" class="form-control" :value="allpurchase.g_total"   disabled>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail4">Paid</label>
                      <input type="text" class="form-control" :value="allpurchase.paid" disabled>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail4">Due</label>
                      <input type="text" class="form-control" :value="allpurchase.due"  disabled>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail4">Due</label>
                      <input type="text" class="form-control" :value="allpurchase.payment_method"  disabled>
                    </div>

                   

                  </div>
                </div>

                <hr>
                <div class="form-group">
                      
                     
                </div>

              </form>
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
        allpurchase: [],
        purchaseDetails: [],
      }
    },

    created(){
        let id = this.$route.params.id
        axios.get('/api/purchase/details/'+id)
        .then(({data})=>(this.allpurchase = data))
        .catch()
        
        axios.get('/api/purchase/details/product/'+id)
        .then(({data})=>(this.purchaseDetails = data))
        .catch()

    }
    


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