<template>
    <div>
      <search-selector  
        v-if="!selected"
        :originalData="transaction.products" 
        :keys="['name','buyingPrice','sellingPrice','unitName','bundleName']"
        @changed="productSearched">
      <label  slot="label">Choose A Product</label>
      <ul class="list-group" v-if="searched">
          <template  v-for="(product,index) in searched">
            <a href="" class="list-group-item list-group-item-action jcsb" v-if="index<4"
               @click.prevent="onSelected(product)">
               {{ product.name }}
             <span class="ml1">
                  <span class="badge badge-warning badge-pill">{{  product.phoneNumber }}</span>
             </span>
             </a>
        </template>
    </ul>
    
</search-selector>
  <product-profile :product="selected" v-if="selected">
    <div>
      <button class="btn btn-outline-danger btn-sm" @click="reset" title="remove  item">
        <i class="fa fa-trash"></i>
      </button>
    </div>
  </product-profile>
</div>
</template>

<script>
import transaction from "./transaction";

import ProductProfile from "./productProfile";

    export default
    {
      components:{ProductProfile},

        data(){
            return {
                searched:null,
                selected:null,
                transaction,
            }
        },
        methods:{
          onSelected(selected)
          {
            this.selected=selected;
            this.searched=null;
            this.$emit("changed",selected);
          },
          productSearched(searched)
          {
            this.searched=searched; 
            this.selected=null;
          },
          reset()
          {
            this.$set(this.$data,'selected',null);
            this.$set(this.$data,'searched',null);
            this.$emit("changed",null);

          }

        }
    }
</script>
