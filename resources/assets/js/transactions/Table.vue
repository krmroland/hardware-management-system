<template>
   <div class="card mt-2">
     <div class="card-body">
       <h4 class="card-title text-center text-primary">Add Products</h4>
          <div class="table-responsive">
           <table class="table table-bordered table-sm">
             <thead>
              <tr class="small fwthin text-nowrap table-primary">
               <th></th>
               <th>Product Name</th>
               <th v-for="(label,name) in transaction.priceMappings" v-text="label"></th>
               <th>Opening Quantity</th>
               <th>New Quantity</th>
               <th>Closing Quantity</th>
               <th v-text="transaction.clientName"></th>
               <th>Subtotals</th>
               <th>Payments</th>
               <th>Balances</th>
               <th class="text-center">
                 <a href="#" @click.prevent="isAddingCartItem=!isAddingCartItem">
                   <i class="fa fa-plus-circle text-muted fa-lg"></i>
                 </a>
               </th>
             </tr>
           </thead>
           <tbody>
             <tr v-for="(item,index) in cartItems">
               <td>{{ ++index }}.</td>
               <td>{{ item.product_name|capitalize }}</td>
               <td>{{ item.buyingPrice|currency }}</td>
               <td>{{ item.sellingPrice|currency }}</td>
               <td>{{ item.openingQuantity}}</td>
               <td>{{ item.newQuantity}}</td>
               <td>{{ item.closingQuantity}}</td>
               <td>{{ item.client_name|capitalize }}</td>
               <td>{{ item.subTotal|currency }}</td>
               <td>{{ item.paid|currency }}</td>
               <td>{{item.balance|currency }}</td>
               <th class="text-center">
                 <a href="#" @click.prevent="removeProduct(index,item)">
                   <i class="fa fa-minus-circle text-muted fa-lg"></i>
                 </a>
               </th>
             </tr>
             <tr v-if="!cartItems.length" >
              <td class="bg-primary text-white text-center" colspan="12" >
                Please add some products to the cart
              </td>
             
             </tr>
           </tbody>
         <!--   <tfoot v-if="products.length">
             <tr class="table-info">
               <th colspan="8" class="text-right">Totals</th>
               <th>{{ total|currency }}</th>
               <th>{{ paid|currency }}</th>
               <th colspan="2">{{ balance|currency }}</th>
             </tr>
           </tfoot> -->
         </table>
         <zoom>
           <add-cart-item 
            @closed="isAddingCartItem=false" 
            v-if="isAddingCartItem" 
            @added="cartItems.push($event); isAddingCartItem=false"
            ></add-cart-item>
         </zoom>
       </div>
     
     </div>
   </div>
     
</template>

<script>
import AddCartItem from "./addCartItem";
import transaction from "./transaction";
    export default
    {
      components:{AddCartItem},


        data(){
            return {
                isAddingCartItem:false,
                transaction,
                cartItems:[]
            }
        },
        methods:{
          removeProduct(index,item)
          {
            this.$delete(this.cartItems,--index);
            this.transaction.removeCartItem(item);
          }

        }
    }
</script>
