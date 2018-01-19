<template>
 <div class="card">
      <div class="card-body level"> 
          <h6 class="text-primary">{{ product.name }}</h6>
          <h6 class="text-muted">
              (bp) {{ product.buyingPrice|currency }}
          </h6>
          <h6 class="text-muted">
              (sp) {{ product.sellingPrice|currency }}
          </h6>
          <h6 class=" text-primary">
          (Qty) {{ product.bundle.name }}
        </h6>
        <slot></slot>
      </div>
    </div>
   
      
</template>

<script>
    export default
    {
        props:["product"]
    }
</script>
