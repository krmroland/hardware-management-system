<template>
  <zoom>
    <div  class="modal fade show" tabindex="-1" role="dialog"  v-if="show"  >
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header bg-success">
          <div></div>
          <h5 class="modal-title text-center ft3 text-white">
           <slot name="title"></slot>
         </h5>
         <button type="button" class="close text-white" @click="$emit('closed')">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">
        <slot></slot>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary"  @click="$emit('closed')" >Close</button>
       <slot name="footer"></slot>
     </div>
   </div>
 </div>
</div>
</zoom>
</template>
<script>
  export default{
    props:["show"],
  }
</script>

