<template>
    <div class="card">
      <div class="card-body level"> 
          <div>
              <img :src="client.avatar" alt="" width="35">
          </div>
          <h6 class="text-primary">{{ client.name }}</h6>
          <h6 class="text-muted">
              <i class="fa fa-phone"></i>
              {{ client.phoneNumber }}
          </h6>
          <h6 class=" text-primary">
            <span  class="small text-muted">Ac Bal (cuurent)</span>
            ({{ client.accountBalance|currency }})
        </h6>
        <slot></slot>
      </div>
    </div>
      
</template>

<script>
    export default
    {
        props:["client"],

        data(){
            return {
            
            }
        }
    }
</script>
