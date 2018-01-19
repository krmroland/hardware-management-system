<template>
  <modal :show="isAddingProduct" @closed="$emit('update:isAddingProduct',false)">
    <span slot="title">Add A new Product to The List</span>
    <form action="">
      <div class="row">
        <div class="col-md-6">   
          <products-selector :products="transactionData.products" @product:selected="productSelected"></products-selector>
        </div>
        <div class="col-md-6">
          <suppliers-selector :suppliers="transactionData.suppliers" @supplier:selected="supplier=$event">

          </suppliers-selector>
        </div>
      </div>
      <div class="box" v-if="product">
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
       <label class="text-nowrap small">Bought At</label>
       <input type="number" class="form-control" placeholder="bought at" v-model="buyingPrice">
     </div>
     <!-- to sell at -->
     <div class="col">
       <label class="text-nowrap small">To sell At</label>
       <input type="number" class="form-control" placeholder="To Sell At" v-model="sellingPrice">
     </div>
     <!-- total quantity-->
     <div class="col">
       <label class="text-nowrap small">Total Qty</label>
       <input type="number" class="form-control" placeholder="Total Qunatity" v-model="totalQuantity">
     </div>
     <!-- subtotal-->
     <div class="col">
       <label class="text-nowrap small">Sub total</label>
       <input type="number" class="form-control" placeholder="Sub Total" v-model="subTotal">
     </div>
     <!-- paid-->
     <div class="col">
       <label class="text-nowrap small">Amount Paid</label>
       <input type="number" class="form-control" placeholder="Amount Paid" v-model="paid">
     </div>
   </div>
 </div>
</form>
<template slot="footer">
  <button type="button" class="btn btn-primary" v-if="product" @click.prevent="dispatchProduct">
    <i class="fa fa-plus"></i>
    Add Product
  </button>
</template >
</modal>

</template>

<script>
  import ProductsSelector from "../products/selector";
  import SuppliersSelector from "../../clients/suppliers/selector";
  export default
  {
    components:{ProductsSelector,SuppliersSelector},

    props:["transactionData","isAddingProduct"],

    data(){
      return {

        product:null,
        supplier:{},
        paid:'',
        buyingPrice:'',
        sellingPrice:'',
        units:'',
        bundles:'',
        paid:'',



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
          return this.bundles*this.product.unitsPerBundle +this.units;
        },
        set(totalQuantity)
        {
         const quantities=this.splitQuantity(totalQuantity);
         this.units=quantities.units;
         if (quantities.bundles) {
          this.bundles=quantities.bundles;
        }
      }

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
                 data:this.product,
                 supplier:this.supplier,
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
                 totalQuantity:this.totalQuantity
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
            Confirmation.info("No way",this.titleCase(prop)+' is required');
            return true;
          }
        })
      //if we have any null fields we abort
      if (nullFields.length>0) return;

      if (this.paid<this.subTotal && !this.supplier.name) {
        Confirmation.info(
                          "No way!",
                          "To enable us track debts, You  have must register suppliers if you are not purchasing on full credit"
                          );
        return;
      }

      this.releaseProduct();
    },
    releaseProduct()
    {
      this.$emit("update:isAddingProduct",false);
      this.$emit("added",this.formatedProduct());
      this.reset();
    },
    reset()
    {
      this.units=0;
      this.bundles=0;
      this.buyingPrice=0;
      this.product=null;
      this.$forceUpdate();
     
    }
  }

}
</script>
