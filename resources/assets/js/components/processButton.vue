<template>
    <button class="btn" :class="className" @click="$emit('clicked')" :disabled="isProcessing">
        <i :class="isProcessing?'fa fa-spin fa-spinner':icon"></i>
        <slot></slot>
    </button>
</template>
<script>
    export default{
        props:{
            className:{default:'btn-outline-primary'},
            isProcessing:{default:false},
            icon:{default:"fa fa-save"}
        }
    }
</script>
