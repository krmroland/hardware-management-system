<template>
	<div class="modal is-active" v-if="shouldProcess">
		<div class="modal-background"></div>
		<zoom>
			<div class="modal-card">
				<section class="modal-card-body p-0 text-center">
					<div class="alert m-0 text-white bg-info h6">
						<strong>
							<i  class="fa p-1 fa-spinner fa-spin" ></i>
							<span v-html="message"></span>
						</strong>
					</div>
				</section>
			</div>
		</zoom>
	</div>
</template>
<script>
	export default{
	
	props:{
			shouldProcess:{
				default:false,
			},
			message:{
				required:true
			}
		}

	}
</script>
