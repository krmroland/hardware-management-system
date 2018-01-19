<template>
    <div>
        <label for="">Please Select A category</label>
        <div class="input-group" v-if="!addingCategory">
         <select class="form-control" name="category_id" required v-model="categoryId">
            <option value="">Please select .........</option>
            <option :value="category.id" v-for="category in categories">
                {{ category.name }}
            </option>
        </select> 
        <button class="btn btn-outline-primary"
        @click.prevent="addingCategory=true" title="New Category">
        <i class="fa fa-plus"></i>
    </button>
</div>
<div class="input-group" v-else>
 <input type="text" class="form-control" placeholder="Category Name" v-model="newCategoryName"
 :disabled="isProcessingCategory">

 <button class="btn btn-outline-primary" @click.prevent="saveCategory" title="save category" 
 :disabled="isProcessingCategory">
 <i class="fa" :class="saveButtonClass"></i>
</button>
<button class="btn btn-outline-primary" @click.prevent="addingCategory=false" title="cancel" 
:disabled="isProcessingCategory">
<i class="fa fa-times"></i>
</button>
</div>


</div>
</template>

<script>
export default
{
    props:["data","selectedId"],

    data(){
        return {
            addingCategory:false,
            newCategoryName:'',
            isProcessingCategory:false,
            categoryId:this.selectedId?this.selectedId:'',
            categories:this.data
        }
    },
    methods:{
        saveCategory()
        {
            if (!this.newCategoryName) {
                Confirmation.info("Please enter A name","No way",'error');
                return false;
            }
            if (this.categories.find((category)=>category.name.toLowerCase()==this.newCategoryName.toLowerCase()))
             {
              Confirmation.info(`The cateory ${this.newCategoryName} already exists`,'Yikes','error');
                return false;
            }
            this.isProcessingCategory=true;
            this.persist();
        },
        persist()
        {
            axios.post("/categories",{name:this.newCategoryName}).then(({data})=>{
                this.categories.unshift(data);
                this.isProcessingCategory=false;
                this.addingCategory=false;
                this.categoryId=data.id;
                flash("category added successfully")
            }).catch((response)=>{
                Confirmation.info('something went wrong','Yikes','error')
                this.isProcessingCategory=false;
            });
        }
    },
    computed:{
        saveButtonClass(){
            return this.isProcessingCategory?'fa-spinner fa-spin':'fa-save';
        }
    }
}
</script>
