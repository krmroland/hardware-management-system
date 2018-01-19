<template>
	<transition 
		enter-active-class="animated bounceInDown"
		leave-active-class="animated fadeOut"
		appear>
		<div class="alert m-0  alert-flash text-white":class="'bg-'+alertType" v-if="shouldShow">
			<strong class="d-flex justify-content-center mx-3 align-items-center">
				<i  class="fa p-1 " :class="[icon,'text-white'] " ></i>
				<span v-text="body"></span>
			</strong>
		</div>
	</transition>
</template>
<script>
	export default
	{

		props:{
			data:{required:true},
		
		},


		data()
		{
			return {
				shouldShow:false,
				body:'',
				alertType:this.data.type,
				message:this.data.message,
				timeOut:{default:true},
				type:{default:'success'}
			};
		},
		created() {
			if (this.message) {
				this.flash(this.message);
			}

			window.events.$on(
				'flash', data => {
					this.alertType=data.type?data.type:'success';
					this.flash(data.message)
				}
				);
		},
		computed:{
			icon()
			{
				if (this.alertType=="success") {
					return "fa-check fa-lg";
				}
				return "fa fa-exclamation-triangle fa-lg";
			}
		},

		methods: {
			flash(message) {
				this.body = message;
				this.shouldShow = true;

				if (this.timeOut) {
					this.hide();
				}

			},

			hide() {
				setTimeout(() => {
					this.shouldShow = false;
				}, 3000);
			}
		}
	}
</script>

<style>
	.alert-flash{
		position: fixed;
		top:55px;
		right:0;
		left:0;
	}
</style>
