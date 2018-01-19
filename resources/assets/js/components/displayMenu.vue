<template>
	<div class="row">
		<div v-for="item in items" class="col-md-4 mb1">
			<hoverable>
				<div class="card">
					<div class="card-block df jcsb  aic">

						<router-link :to="item.href">
							<p class="title">	{{item.label}}</p>
						</router-link>
						<div class="icon-medium" :class="item.icon"></div>
					</div>
				</div>
			</hoverable>
		</div>
	</div>
</template>
<script>
	export default
	{
		props:["items"],

		data(){
			return {
			
			}
		}
	}
</script>

