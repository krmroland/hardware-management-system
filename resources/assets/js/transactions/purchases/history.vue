<template>
    <card>
        <span slot="title"> Recently Made Purchases</span>
        <div>
            <table class="table table-bordered table-hover table-sm table-stripped">
                <thead>
                    <tr class="fwthin small">
                        <th>Date</th>
                        <th>Product</th>
                        <th>Available Quantity</th>
                        <th>Purchased Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="purchase in purchases">
                        <td>{{ purchase.date }}</td>
                        <td>{{ purchase.name }}</td>
                        <td>{{ purchase.quantity }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </card>
</template>

<script>
    export default
    {
        props:["purchasesData"],
        created()
        {
            axios.get("/api/purchases").then(({data})=>this.purchases=data)
        },

        data(){
            return {
              purchases:[]
            }
        }
    }
</script>
