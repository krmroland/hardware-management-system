<template>
    <div>
      <client-search :originalData="products" :keys="['name','unitName','bundleName']"  @changed="onSearched">
      <label  slot="label">Select An Product</label>
      <ul class="list-group" v-if="searched">
          <template  v-for="(product,index) in searched">
            <a href="" class="list-group-item list-group-item-action jcsb" v-if="index<4"
               @click.prevent="onSelected(product)">
               {{ product.name }}
             <span class="ml1">
                  <span class="badge badge-warning badge-pill">{{  product.bundle.name }}</span>
             </span>
             </a>
        </template>
    </ul>
    <ul class="list-group" v-if="selected" >
       <li class="list-group-item bg-light text-info">
        <i class="fa fa-check"></i>
        <span class="ml1">{{ selected.name }}</span>
        <span class="ml1">
             <span class="badge badge-warning badge-pill">{{  selected.bundle.name }}</span>
        </span>
       </li>
    </ul>
</client-search>

</div>
</template>

<script>
    export default
    {
        props:["products"],

        data(){
            return {
                searched:null,
                selected:null
            }
        },
        methods:{
          onSelected(selected)
          {
            if (selected.hasOwnProperty("name")) {
              this.selected=selected;
              this.searched=null;
              this.$emit("product:selected",selected);
            }
            
          },
          onSearched(searched)
          {
            this.searched=searched; 
            this.selected=null;
          },

        }
    }
</script>
