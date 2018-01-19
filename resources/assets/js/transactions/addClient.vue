<template>
    <div>
      <search-selector  
        v-if="!selected"
        :originalData="transaction.clients" 
        :keys="['name','phoneNumber']"
        @changed="clientSearched">
      <label  slot="label">Select A {{ transaction.clientName }}</label>
      <ul class="list-group" v-if="searched">
          <template  v-for="(client,index) in searched">
            <a href="" class="list-group-item list-group-item-action jcsb" v-if="index<4"
               @click.prevent="onSelected(client)">
               {{ client.name }}
             <span class="ml1">
                  <span class="badge badge-warning badge-pill">{{  client.phoneNumber }}</span>
             </span>
             </a>
        </template>
    </ul>
    
</search-selector>
  <client-profile :client="selected" v-if="selected">
   <button class="btn btn-outline-danger btn-sm m-0" @click="reset" title="remove  item">
     <i class="fa fa-trash"></i>
   </button>
  </client-profile>
</div>
</template>

<script>
import transaction from "./transaction";
import ClientProfile from "./clientProfile";

    export default
    {
      components:{ClientProfile},

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
          clientSearched(searched)
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
