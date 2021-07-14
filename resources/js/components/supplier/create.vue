<template>
<div style="margin-top:-72px">
    <h4 class="section-subtitle"><router-link to="/supplier" class="btn btn-sm btn-success">All Supplier </router-link></h4>
    <div class="card">
        
        <div class="card-header">
            Add Supplier
        </div>
        <div class="card-body">
            <form @submit.prevent="supplierInsert" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Full Name</label>
                        <input type="text" class="form-control" v-model="form.name" placeholder="Supplier Name">
                        <small class="text-danger" v-if="errors.name" > {{ errors.name[0] }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Company Name</label>
                        <input type="text" class="form-control" v-model="form.company_name" placeholder="Enter Company Name">
                        <small class="text-danger" v-if="errors.company_name" > {{ errors.company_name[0] }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Email</label>
                        <input type="email" class="form-control" v-model="form.email" placeholder="Enter Supplier Email">
                        <small class="text-danger" v-if="errors.email" > {{ errors.email[0] }}</small>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Phone Number</label>
                        <input type="number" class="form-control" v-model="form.phone" placeholder="Enter Phone Number">
                        <small class="text-danger" v-if="errors.phone" > {{ errors.phone[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Adress</label>
                        <input type="text" class="form-control" v-model="form.address" >
                        <small class="text-danger" v-if="errors.address" > {{ errors.address[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Description</label>
                        <input type="text" class="form-control" v-model="form.discription" >
                        <small class="text-danger" v-if="errors.discription" > {{ errors.discription[0] }}</small>
                    </div>
                    
                    
                    
                    
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Supplier Image</label>
                        <input type="file" class="form-control"  @change="onFileSelected">
                        <small class="text-danger" v-if="errors.photo" > {{ errors.photo[0] }}</small>
                    </div>
                    <div class="form-group col-md-6">
                        
                        <img :src="form.photo" style="height: 105px;width: 105px;">
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
               name: null,
               email: null,
               phone: null,
               address: null,
               discription: null,
               photo: null,
               company_name: null,
           },
           errors:{}
       }
   },

   methods:{
       supplierInsert(){
           axios.post('/api/supplier',this.form)
           .then((res)=>{
               this.$router.push('/supplier')
               Notification.success();
           })
           .catch(error =>{
               Notification.error();
               this.errors = error.response.data.errors
           })
       },

       onFileSelected(event){
            
            let file = event.target.files[0];
            if(file.size > 1048770)
            {
                Notification.image_validation();
            }else{
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.photo = event.target.result
                };
                reader.readAsDataURL(file);
                
            }
        },
   }
}
</script>

