<template>
<div style="margin-top:-72px">
    <h4 class="section-subtitle"><router-link to="/employee" class="btn btn-sm btn-success">All Product </router-link></h4>
    <div class="card">
        
        <div class="card-header">
            Add Product
        </div>
        <div class="card-body">
            <form @submit.prevent="productInsert" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Product Name</label>
                        <input type="text" class="form-control" v-model="form.product_name" placeholder="Product Name">
                        <small class="text-danger" v-if="errors.product_name" > {{ errors.product_name[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Product Code</label>
                        <input type="text" class="form-control" v-model="form.product_code" placeholder="Enter Product Code">
                        <small class="text-danger" v-if="errors.product_code" > {{ errors.product_code[0] }}</small>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Category</label>
                        <select name="country"  class="form-control" v-model="form.category_id">
                        
                          <option :value="category.id"  v-for="category in categories" :key="category.id">{{ category.category_name}}</option>           
                            
                        </select>
                        <small class="text-danger" v-if="errors.category_id" > {{ errors.category_id[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Root</label>
                        <input type="text" class="form-control" v-model="form.root" >
                        <small class="text-danger" v-if="errors.root" > {{ errors.root[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Selling Price</label>
                        <input type="number" class="form-control" v-model="form.selling_price" placeholder="Enter Selling Price" step="0.01">
                        <small class="text-danger" v-if="errors.selling_price" > {{ errors.selling_price[0] }}</small>
                    </div>
                    
                    
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Qty</label>
                        <input type="number" class="form-control" v-model="form.product_quantity" placeholder="Enter Product QTY">
                        <small class="text-danger" v-if="errors.product_quantity" > {{ errors.product_quantity[0] }}</small>
                    </div>
                    
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Product Image</label>
                        <input type="file" class="form-control"  @change="onFileSelected">
                        <small class="text-danger" v-if="errors.product_image" > {{ errors.product_image[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        
                        <img :src="form.product_image" style="height: 105px;width: 105px;">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>  
</template>

<script>
export default {
    created()
    {
        
        if(!User.loggedIn())
        {
            this.$router.push({name: '/'})
        }
        
    },

    data(){
        return{
            form:{
                'category_id':      null,
                'product_name':     null,
                'product_code':     null,
                'root':             null,
                'selling_price':    null,
                'product_image':    null,
                'product_quantity': null,
                
            },
            errors:{},
            categories:[],
        }
    },

    created(){
        
            axios.get('/api/category/')
            .then(({data})=> (this.categories = data))
            
    },
    methods:{

        onFileSelected(event){
            
            let file = event.target.files[0];
            if(file.size > 1048770)
            {
                Notification.image_validation();
            }else{
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.product_image = event.target.result
                };
                reader.readAsDataURL(file);
                
            }
        },

        productInsert(){
            axios.post('api/product',this.form)
            .then(res => {
                
                this.$router.push('/product')
                Notification.success();

                })
            
            .catch(error => {
                this.errors = error.response.data.errors
                }
            )
        }
    }
}
</script>

