<template>
<div :class="animationClass" @mouseover="hoverIt" @mouseleave="unhoverIt">
	<slot></slot>
</div>
	
</template>

<script>
	export default{

		props:{
			animation:{
				default:'pulse'
			}
		},
		data(){
			return{
				animationClass:''
			}
		},

		methods:{

			hoverIt(){
				this.animationClass=`animated ${this.animation}`;

			},

			unhoverIt(){

				this.animationClass='';
			}
		}
	}
</script>