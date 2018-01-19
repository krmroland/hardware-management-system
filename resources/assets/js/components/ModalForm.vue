<template>
	<modal :show="shouldShow" @closed="closed">
		<span slot="header">
			<slot name="title"></slot>
		</span>
		<vue-form :action="action" :method="method" :fields="fields" @submitted="submitted">
			
		</vue-form>
	</modal>
</template>

<script>
	import VueForm from "../forms/VueForm";

	export default
	{
		props:{
			action:{
				required:true,
			},
			method:{
				default:"post",
			},
			shouldShow:{
				required:true,
			},
			fields:{
				required:true,
				type:Array
			}
		},

		components:{VueForm},

		
		methods:{
			closed()
			{
				this.$emit("update:shouldShow",false);
			},
			submitted(payLoad)
			{
				this.$emit("update:shouldShow",false);
				this.$emit("submitted",payLoad);

			}
		}
	}
</script>
