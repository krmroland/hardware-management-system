<template>
  <div class="bg-masked p-3 border-primary border">
    <div class="card">
        <div class="card-body">
            <div class="level">
                <i class="fa fa-balance-scale fa-2x text-primary"></i>
                <h5 class="text-primary">Add A new Item to the cart</h5>
                <button class="btn btn-outline-secondary" @click="$emit('closed')">
                    <i class="fa fa-times"></i>
                    Close
                </button>
            </div>
        
           <div class="row mt-2">
             <div class="col-md-6">   
              <add-product @changed="selectedProduct=$event"></add-product>
             </div>
             <div class="col-md-6">
               <add-client @changed="selectedClient=$event"></add-client>
             </div>
           </div>
           <cart-item 
           v-if="selectedProduct" 
           :product="selectedProduct"
           :client="selectedClient"
           @added="$emit('added',$event)"
           ></cart-item>
        </div>
      </div>
  </div>
      
</template>

<script>
import AddClient from "./addClient";
import AddProduct from "./addProduct";
import transaction from "./transaction";
import CartItem from "./cartItem";

    export default
    {

        components:{AddClient,AddProduct,CartItem},
        data(){
            return {
                transaction,
                selectedProduct:null,
                selectedClient:null
            }
        }
    }
</script>
