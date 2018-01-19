<template>

  <div>
    <card>
      <h4 class="card-title text-center text-primary" v-text="title"></h4>
     <form :action="action" method="post" ref="form" @submit.prevent="makeTransaction">
        <div class="level">
         <div class="col-4">
           <date label="Select The transaction Date" @dateChanged="transaction.date=$event"></date>
         </div>

        
        <input type="hidden" name="_token" :value="csrf_token">
        <input type="hidden" name="cartItems" value="" ref="cartItems">
           <processButton  icon="fa fa-shopping-basket" :isProcessing="isProcessing">
             {{ buttonText }}
           </processButton>
           <div class="icon-small" :class="icon"></div>
        </div>
        </form>
    </card>
    <transaction-table></transaction-table>
  </div>
   
      
</template>

<script>
import TransactionTable from "./Table";
import transaction from "./transaction";

    export default
    {
        components:{TransactionTable},
        props:["transactionData","title","icon","action","buttonText","clientName","priceMappings"],
        created(){
            //we will wrap all the props into  a single object since they are shared
            transaction.props=this.$props;
        },

        data(){
            return {
                transaction,
                isProcessing:false,
            }
        },
        methods:{
            makeTransaction()
            {
                if (!this.transaction.cartItems.length) {
                    Confirmation.info("Please select some products before proceeding");
                    return;

                }
                this.$refs.cartItems.value= JSON.stringify(this.transaction.cartItems);
                this.$refs.form.submit();
              
            }
        },
    }
</script>
