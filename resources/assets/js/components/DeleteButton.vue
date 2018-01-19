<template>
    <form :action="action"  method="post" @submit.prevent="preConfirm">
        <input type="hidden" :value="csrf_token" name="_token">
        <input type="hidden" name="_method" value="delete">
        <button class="btn btn-danger" type="submit" :disabled="isProcessing">
            <i :class="classes"></i>
            <slot></slot>
        </button>
    </form>
</template>

<script>
    export default
    {
        props:["action","confirmationMessage"],
        data()
        {
            return {
                isProcessing:false,
            }
        },
        methods:{
            preConfirm()
            {
                Confirmation.confirm("The item will be deleted permanently","Stop").then(confirmed=>{
                    this.isProcessing=true;
                    this.$el.submit();
                })
            }
        },
        computed:{
            classes()
            {
                return ["fa",this.isProcessing?'fa fa-spinner fa-spin':'fa-trash'];
            }
        }
    }
</script>
