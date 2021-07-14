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

    <div class="row animated fadeInRight">
                <!--BORDERED-->
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <span class="badge x-success">Purchase Value =Tk {{ purchaseValue }}</span>
                            <span class="badge x-o x-warning">Purchase Due =Tk {{ purchaseDue }}</span>
                            <input type="text" class="pull-right" placeholder="serch" v-model="serchProduct" >
                            
                            <br>
                            <br>
                            <div class="table-responsive" style="border-top: 2px solid #ececec;">
                                <table class="table table-striped table-hover table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Invoice No.</th>
                                        <th>Date</th>
                                        <th>Supplier</th>
                                        <th>G.Total</th>
                                        <th>Due</th>
                                        <th>Payment</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="purchase in allPurchase" :key="purchase.id">
                                        
                                        <td>{{ purchase.invoice_number}}</td>
                                        <td>{{ purchase.date}}</td>
                                        <td>{{ purchase.supplier_id}}</td>
                                        <td>{{ purchase.g_total}}</td>
                                        <td>{{ purchase.due}}</td>
                                        <td>{{ purchase.payment_method}}</td>
                                        
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <router-link :to="{name:'purchaseDetails', params:{id:purchase.id}}" class="btn btn-transparent"><i class="fa fa-eye"></i>
                                                </router-link>

                                                <button class="btn btn-transparent"><i class="fa fa-pencil"></i>
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
            allPurchase:[],
        }
    },

    created(){
        axios.get('/api/purchase/list/')
        .then(({data}) => (this.allPurchase = data))
        .catch()

    },

    computed:{
        purchaseValue(){
            let sum = 0;
            for(let i = 0; i < this.allPurchase.length; i++){
                sum += (parseFloat(this.allPurchase[i].g_total));
            }
            return sum;
        },
        purchaseDue(){
            let sum = 0;
            for(let i = 0; i < this.allPurchase.length; i++){
                sum += (parseFloat(this.allPurchase[i].due));
            }
            return sum;
        },
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
