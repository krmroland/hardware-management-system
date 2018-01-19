<template>
	<div class="dropdown is-right is-active">
		<div class="dropdown-trigger df aic jcsb" aria-haspopup="true" >
			<span class="mh1 ft2 text-primary serif" v-if="showSelected">{{activeOption|title}}</span>
			<a href="" @click.prevent="display=!display">
				<i class="fa fa-ellipsis-v fa-lg text-muted"  ></i>
			</a>
		</div>
		<div class="dropdown-menu " v-if="display">
			<div class="dropdown-content pa0 ma0" v-for="(option,index) in options">
				<a href="#" class="dropdown-item  code ft2" @click.prevent="selectOption(index)">
					{{option|title}}
				</a>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		props:{
			options:{
				type:Array,
				required:true
			},
			showSelected:{
				default:true
			}
		},
		data()
		{
			return{
				display:false,
				activeOption:this.options[0],
			} 
		},
		methods:{
			selectOption(index)
			{
				this.activeOption=this.options[index];

				this.display=false;

				this.announceSelection();
				
			},
			announceSelection()
			{
				this.$emit("option:selected",this.activeOption);
			}
		}
	}
</script>
