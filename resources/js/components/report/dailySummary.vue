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
                            <div class="col-12 text-center" style="line-height:7px">
                                <h3>Daily Summary Report</h3>
                                
                                <p>Date : {{date}}</p>
                            </div>
                            <br>
                            <hr>
                            <h5 class="text-center" >Purchase</h5>
                            <hr>
                            <!-- purchase report start -->
                            <table class="table table-bordered" >
                                <thead  style="border:1px solid #000;">
                                    <tr>
                                    <th scope="col" style="border:1px solid #000;">Invoice</th>
                                    <th scope="col" style="border:1px solid #000;">Supplier</th>
                                    <th scope="col" style="border:1px solid #000;">G. Total</th>
                                    <th scope="col" style="border:1px solid #000;">Paid</th>
                                    <th scope="col" style="border:1px solid #000;">Due</th>
                                    </tr>
                                </thead>
                                <tbody  style="border:1px solid #000;" >
                                    
                                    <tr style="border:1px solid #000;" v-for="purchase in purchases" :key="purchase.id">
                                        <td style="border:1px solid #000;">{{ purchase.invoice_number }}</td>
                                        <td style="border:1px solid #000;">{{ purchase.name }}</td>
                                        <td style="border:1px solid #000;">{{ purchase.g_total }}</td>
                                        <td style="border:1px solid #000;">{{ purchase.paid }}</td>
                                        <td style="border:1px solid #000;">{{ purchase.due }}</td>
                                    </tr>
                                    <tr style="border:1px solid #000;">
                                        <td style="border:1px solid #000;"></td>
                                        <td style="border:1px solid #000;">Sum</td>
                                        <td style="border:1px solid #000;">{{ purchaseTotal }}</td>
                                        <td style="border:1px solid #000;">{{ purchasePaid }}</td>
                                        <td style="border:1px solid #000;">{{ purchaseDue }}</td>
                                    </tr>
                                </tbody>
                                </table>
                            <!-- purchase report end -->
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
            purchases:[],
            date:'',
        }
    },

    created(){

        axios.get('/api/daily/purchase/report/')
        .then(({data}) => (this.purchases = data))
        .catch()

        this.date = new Date();


    },

    methods:{
        
    },
    computed:{
        purchaseTotal()
        {
            
            let sum = 0;
            for(let i=0;i<this.purchases.length;i++)
            {
                    sum += (parseFloat(this.purchases[i].g_total));
            }
            return sum;
        },
        purchasePaid(){
            let sum =0;
            for(let i=0;i<this.purchases.length;i++){
                sum += (parseFloat(this.purchases[i].paid));
            }
            return sum;
        },
        purchaseDue(){
            let sum =0;
            for(let i=0;i<this.purchases.length;i++){
                sum += (parseFloat(this.purchases[i].due));
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
