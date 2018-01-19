<template>

 <div class="relative">
   <card>
    <div class="box">
      <div class="level">
       <div class="col-4">
         <date label="purchasing date" @dateChanged="date=$event"></date>
       </div>
      <div>
      <form action="/purchases" method="post" ref="form" @submit.prevent="makePurchase">
      <input type="hidden" name="date" :value="date">
      <input type="hidden" name="_token" :value="csrf_token">
      <input type="hidden" name="products" :value="products|json">
         <processButton  icon="fa fa-shopping-basket" :isProcessing="isProcessing">
            Process And Submit Form
         </processButton>
      </form>
     
      </div>
       <div class="icon-small icon-shopping-basket"></div>
     </div>
     <div class="table-responsive">
      <table class="table table-bordered table-striped table-sm">
        <thead>
         <tr class="small fwthin text-nowrap">
          <th></th>
          <th>Product Name</th>
          <th>Bought At</th>
          <th>To Sale At</th>
          <th>Opening Quantity</th>
          <th>New Quantity</th>
          <th>Closing Quantity</th>
          <th>Supplier</th>
          <th>Subtotals</th>
          <th>Payments</th>
          <th>Balances</th>
          <th class="text-center">
            <a href="#" @click.prevent="isAddingProduct=true">
              <i class="fa fa-plus-circle text-muted fa-lg"></i>
            </a>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product,index) in products">
          <td>{{ ++index }}.</td>
          <td>{{ product.data.name|capitalize }}</td>
          <td>{{ product.buyingPrice|currency }}</td>
          <td>{{ product.sellingPrice|currency }}</td>
          <td>{{ product.openingQuantity}}</td>
          <td>{{ product.newQuantity}}</td>
          <td>{{ product.closingQuantity}}</td>
          <td>{{ (product.supplier.name?product.supplier.name:'....')|capitalize }}</td>
          <td>{{ product.subTotal|currency }}</td>
          <td>{{ product.paid|currency }}</td>
          <td>{{product.balance|currency }}</td>
          <th class="text-center">
            <a href="#" @click.prevent="removeProduct(index,product)">
              <i class="fa fa-minus-circle text-muted fa-lg"></i>
            </a>
          </th>

        </tr>
      </tbody>
      <tfoot v-if="products.length">
        <tr class="table-info">
          <th colspan="8" class="text-right">Totals</th>
          <th>{{ total|currency }}</th>
          <th>{{ paid|currency }}</th>
          <th colspan="2">{{ balance|currency }}</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <div v-if="!products.length" class="alert alert-info jcc">
   Please select some products
 </div>
</div>
</card>
<div class="relative">
  <add-Product :transactionData="transactionData" :isAddingProduct.sync="isAddingProduct" @added="addNewProduct"></add-Product>
</div>

</div>
</template>

<script>

  import AddProduct from "./addProduct";
  export default
  {
    components:{AddProduct},
    props:["data"],

    data(){
      return {
        date:'',
        transactionData:this.data,
        products:[],
        isAddingProduct:false,
        isProcessing:false
      }
    },
    computed:{
     total()
     {
      return this.totalMaker(nextProduct=>nextProduct.subTotal);
    },
    balance()
    {
      return this.totalMaker(nextProduct=>nextProduct.balance);
    },
    paid()
    {
      return this.totalMaker(nextProduct=>nextProduct.paid);
    }
  },
  methods:{
    totalMaker(closure)
    {
      return this.products.reduce((previousSum,nextProduct)=>{
        return previousSum+Number(closure(nextProduct));
      },0);
    },
    addNewProduct(selectedProduct)
    {
        //we will shut down the adding model 
        this.isAddingProduct=false;
        //we will delete the product from the array to avoid double searching
        let indexToDelete=this.transactionData.products.findIndex(product=>{
          return product.product_id==selectedProduct.data.product_id;
        });

        if (indexToDelete!=-1) {
         this.transactionData.products.splice(indexToDelete,1);
         console.log(this.transactionData.products)
        }
        this.products.push(selectedProduct);
      },
      removeProduct(index,product)
      {
        //remove the product from the selected products;
        //we will decrease the index by 1 since we had increased it for numbering
        this.products.splice(--index,1);
        //add the product back to the transaction product just in case they are to select it again
        this.transactionData.products.push(product.data);
      },
      makePurchase()
      {
        this.validate().then(validated=>{
          this.isProcessing=true;
         this.$refs.form.submit();
        }).catch(field=>{
          Confirmation.info("That cant be","Please select "+ field+ " !");
        })
      },
      validate()
      {
        return new Promise((valid,invalid)=>{
           if (!this.date) {
                invalid("a date");
           }
           if (this.products.length<1) {
            invalid("some items");
           }
           valid(true);
        });
      }

    }
  }
</script>
