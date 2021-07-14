<template>
<div class="col-lg-6" style="margin-top:-72px">
    <h4 class="section-subtitle"><router-link to="/category" class="btn btn-sm btn-success">All Category </router-link></h4>
    <div class="card">
        
        <div class="card-header">
            Add Category
        </div>
        <div class="card-body">
            <form @submit.prevent="categoryInsert" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Category Name</label>
                        <input type="text" class="form-control" v-model="form.category_name" placeholder="Category Name">
                        <small class="text-danger" v-if="errors.category_name" > {{ errors.category_name[0] }}</small>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="inputEmail4"></label>
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>
                    
                </div>
                
                
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
                category_name:   null,
            },
            errors:{}
        }
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
                    this.form.emp_image = event.target.result
                };
                reader.readAsDataURL(file);
                
            }
        },

        categoryInsert(){
            axios.post('api/category',this.form)
            .then(res => {
                this.$router.push('/category')
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

