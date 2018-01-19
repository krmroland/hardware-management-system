<template>
	
	<transition-group enter-active-class="delay-2s animated fadeInDownBig"
					 leave-active-class="delay-2s animated fadeOutUpBig"
					 leave-to-class=" animated fadeOutUpBig"
					 move-class=" animated pulse"
					 appear
	
					>
					<slot></slot>
	</transition-group>
</template>

<style>
	.delay-2s{
		animation-duration:1.5s;
	}
</style>