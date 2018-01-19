<template>
    <div>
        <card>
            <div class="df jcsb aic box">
                <div class="icon-medium icon-team "></div>
                <h2 class="text-center ft7 code">Purchases Platform</h2>
                <dropdown :options="['purchaseHistory','newPurchase']" @option:selected="page=$event"></dropdown>
            </div>
        </card>
        <zoom>
            <component :is="page" :purchasesData="transactionalData"></component>
        </zoom>
    </div>
</template>

<script>

    import NewPurchase from "./create";

    import PurchaseHistory from "./history";
    export default
    {
        components:{NewPurchase,PurchaseHistory},

        props:[],

        created()
        {
          this.fetchTransactionalData();
       },


      data(){
        return {
            page:"purchaseHistory",
            transactionalData:[]
        }
    },
    methods:{
      fetchTransactionalData()
      {
        axios.get("/api/purchases/create").then(({data})=>{
          this.transactionalData=data;
      });
    }
}
}
</script>

