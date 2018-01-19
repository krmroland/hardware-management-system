<template>
<div class="card mt-2">
  <div class="card-body">
    
        <div class="row no-gutters">
         <!-- quantity in bundle name -->
         <template v-if="product.bundleName">
           <div class="col">
            <label class="small text-nowrap">Qty ({{product.bundle.bundlePlural}})</label>
            <input type="text" class="form-control" :placeholder="product.bundle.bundlePlural" v-model="bundles" >
          </div>
        </template>
        <!-- unit quantity  -->
        <div class="col">
         <label class="text-nowrap small">Qty in  ({{product.bundle.unitPlural}})</label>
         <div >
           <input type="number"  class="form-control" v-model.number="units" 
           :placeholder="product.bundle.unitPlural"  v-if="!product.bundleName" >
           <select class="form-control" v-model.number="units" style="height:100%"  v-else>
             <option value="0"> 0 ({{product.bundle.unitPlural}})</option>
             <template v-for="unit in Number(product.unitsPerBundle)-1">
               <option :value="unit">
                 {{ unit}} ({{unit==1?product.unitName:product.bundle.unitPlural}})
               </option>
             </template>
           </select>
         </div>
       </div>
       <!-- purchased at -->
       <div class="col">
        <label class="text-nowrap small" v-text="transaction.buyingPriceLabel"></label>
        <input type="number" 
          class="form-control" 
          :placeholder="transaction.buyingPriceLabel"
          v-model.number="buyingPrice"
         >
      </div>
      <!-- to sell at -->
      <div class="col">
        <label class="text-nowrap small text-center" v-text="transaction.sellingPriceLabel"></label>
        <input type="number" class="form-control" 
          :placeholder="transaction.sellingPriceLabel"
          v-model.number="sellingPrice">
      </div>
     
    </div>

    <div  class="row no-gutters">
      <!-- total quantity-->
      <div class="col">
        <label class="text-nowrap small">Total Qty</label>
        <input type="number" class="form-control" placeholder="Total Qunatity" v-model.number="totalQuantity">
      </div>
      <!-- subtotal-->
      <div class="col">
        <label class="text-nowrap small">Sub total</label>
        <input type="number" class="form-control" placeholder="Sub Total" v-model.number="subTotal">
      </div>
      <!-- paid-->
      <div class="col">
        <label class="text-nowrap small">Amount Paid</label>
        <input type="number" class="form-control" placeholder="Amount Paid" v-model.number="paid">
      </div>
      <!-- paid-->
      <div class="col">
        <label class="text-nowrap small">Receipt No:</label>
        <input type="string" class="form-control" placeholder="Receipt Number" v-model="receipt">
      </div>
    </div>
   <div class="form-group mt-2">
      <button class="btn btn-secondary" @click="dispatchProduct">
       <i class="fa fa-shopping-cart"></i>
       Add Item to The Cart
     </button>
   </div>
  </div>
</div>

</template>

<script>
import {get} from "lodash";
import transaction from "./transaction";

  export default
  {


    props:["product","client"],

    data(){
      return {
        paid:'',
        buyingPrice:this.product.buyingPrice,
        sellingPrice:this.product.sellingPrice,
        units:'',
        bundles:'',
        paid:'',
        receipt:'',
        transaction



      }
    },
    computed:{
      subTotal:{
        get()
        {
          return this.totalQuantity*this.buyingPrice;
        },
        set(subTotal)
        {
          //avoid devision by zero
          if (this.buyingPrice<1) {
            return;
          }
          this.totalQuantity=subTotal/this.buyingPrice;
        }
      },
      totalQuantity:{
        get()
        {
          return Number(this.bundles)*this.product.unitsPerBundle +Number(this.units);
        },
        set(totalQuantity)
        {
         const quantities=this.splitQuantity(totalQuantity);
         this.units=quantities.units;
         if (quantities.bundles) {
          this.bundles=quantities.bundles;
        }
      }
    },
    nullClientMessage()
    {
       return transaction.clientName+ "is required to enable track debts";
    }
  },
  methods:{
    splitQuantity(totalQuantity)
    {
        //given than we have no units per bundle , the total units will be essentially the total units
        if (this.product.unitsPerBundle<0) {
          return {units:totalQuantity};
        }
        const units=totalQuantity%this.product.unitsPerBundle;
        const bundles=Math.floor(totalQuantity/this.product.unitsPerBundle);
        return {bundles,units}
      },

      formatedProduct()
      {
       return {
                 product_id:this.product.id,
                 product_name:this.product.name,
                 client_id:get(this.client,'id',null),
                 client_name:get(this.client,'name','...'),
                 paid:this.paid,

                 buyingPrice:this.buyingPrice,
                 sellingPrice:this.sellingPrice,
                 //computed
                 subTotal:this.subTotal,
                 openingQuantity:this.openingQuantity(),
                 newQuantity:this.newQuantity(),
                 closingQuantity:this.closingQuantity(),
                 paid:this.paid,
                 balance:this.balance(),
                 totalQuantity:this.totalQuantity,
                 receipt:this.receipt
             }

           },
           openingQuantity()
           {
             return this.product.bundle.name;
           },
           newQuantity()
           {
             const units= this.units+ " "+this.product.bundle.unitPlural;
             //does this product have bundles
             if (!this.product.bundleName) {
               return units;
             }
             return this.bundles+' '+this.product.bundle.bundlePlural+' '+units;
           },
           closingQuantity()
           {
             const quantities=this.splitQuantity(this.totalQuantity+Number(this.product.availableQuantity));
             let closing="";
             if (quantities.bundles>0) {
              closing+=quantities.bundles+' '+this.product.bundle.bundlePlural;
             }
             return closing+' '+quantities.units+' '+this.product.bundle.unitPlural;
           },
           balance()
           {
              return this.paid-this.subTotal;
           },
           productSelected(product)
           {
            this.product=product;
            this.buyingPrice=product.buyingPrice;
            this.sellingPrice=product.sellingPrice;
          },
          dispatchProduct()
          {
        //filter null fields
        const nullFields= Array("product","buyingPrice","sellingPrice","totalQuantity","subTotal").filter(prop=>{
          if (!this[prop] || this[prop]<1) {
            Confirmation.info(this.titleCase(prop)+' is required',"No way");
            return true;
          }
        })
      //if we have any null fields we abort
      if (nullFields.length>0) return;

      if (this.paid!=this.subTotal && !this.client) {
        Confirmation.info(this.nullClientMessage,"No way!");
        return;
      }

      this.releaseProduct();
    },
    releaseProduct()
    {
     this.transaction.addCartItem(this.formatedProduct());
     this.$emit("added",this.formatedProduct());
    }
  }

}
</script>
