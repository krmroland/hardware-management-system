<template>
	<card>
		This page may be removed
	</card>
	
</template>

<script>
	import DisplayMenu from "../components/displayMenu";

	export default
	{
		components:{DisplayMenu},
		props:[],

		data(){
			return {
				
			}
		},
		computed:{
			items()
			{
				return  _.map(this.company.mobileMoney,(item)=>{
					return item.card;
				});
			}
		}
	}
</script>
