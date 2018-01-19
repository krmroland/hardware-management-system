<template>
	<transition
	enter-active-class="animated zoomIn"
	leave-active-class="animated zoomOut"
	leave-to-class="animated zoomOut"
	appear
	mode="out-in" 
	>
	<slot></slot>
</transition>
</template>
