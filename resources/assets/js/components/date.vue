<template>
	<div class="form-group" :class="{ hasDanger: hasError }">
		<label class="h6 text-primary">{{label| title }}</label>
		<input type="text" :name="name"  class="form-control flatpickr text-center"  ref="input">

		<p class="form-text text-danger" v-if="hasError" v-text="errorText">

		</p>
	</div>
	
</template>

<script>
	const Flatpickr = require("flatpickr");

	import weekSelect from "flatpickr/dist/plugins/weekSelect/weekSelect";
	
	import moment from "moment";



	export default {

		props:{
			label:{
				default:"Select a date"
			},
			name:{
				type:String,
				default:'date'
			},
			
			mode:{
				type:String,
				default:"single"
			},
			placeholder:{
				type:String,
				default:this.name
			},
			error:{
				type:String,
				default:''
			}
		}
		,

		mounted()
		{

			this.activateCalendar();

		//	this.$emit('dateChanged',this.defaultDate);

	},
	data()
	{
		return {
			errorText:false,
		}
	}
	,methods:{
		activateCalendar()
		{
			new Flatpickr(this.$refs.input,{
				mode:this.mode,
				//weekNumbers:true,
				plugins:this.plugins,
					//enableTime:true,
					maxDate:moment().format("YYYY-MM-DD"),
					defaultDate:this.defaultDate,
					onChange:(selectedDates, dateStr, instance)=> {
						this.dispatchDate(dateStr);
					},
					onReady:(selectedDates,dateStr)=>{ 

						this.dispatchDate(dateStr);
					}

				})
		},
		dispatchDate(date)
		{

			if (this.mode=="range") {
				if(date.includes("to")){
					this.$emit('dateChanged',date);
				}
			}else{
				this.$emit('dateChanged',date);
			}

		}
	}
	,
	computed:
	{
		hasError()
		{
			if(this.error)
			{
				this.errorText=this.error;

				return true;
			}

			return false;
		},
		defaultDate()
		{
			switch (this.mode) {
				case "range":
				return moment().subtract(7,"days").format("YYYY-MM-DD")+" to "+ moment().format("YYYY-MM-DD")
				default:
				return moment().format("YYYY-MM-DD");
			}
		},
		plugins()
		{
			if (this.mode=="weeks") {
				return [new weekSelect({})];
			}

			return [];

		}
	},

	watch:{
		mode()
		{
			this.activateCalendar();
		}
	}



}
</script>

