<template>
	<div class="card border border-light table-responsive">
		<div class="card-body ">
			<div class="d-flex align-items-center mb-2 justify-content-between">
				<!-- <slot></slot> -->
				<!--  <h4 class="ml-auto text-primary">{{ label }}</h4> -->
				<div class="d-flex justify-content-between align-items-center">
					<span class="mx-2  font-size-2 text-dark">Show</span>
					<select class="form-control form-control-sm" @change="changePerPage">
						<option>10</option>
						<option>25</option>
						<option>50</option>
						<option>100</option>
					</select>
					<span class="mx-2 font-size-2 text-dark">entries</span>
				</div>
				<span class="font-size-2" v-if="results.totalItems">
					Page 
					<span class="text-primary">{{ results.currentPage|currency }}</span> of 
					<span class="text-primary">{{ results.lastPage|currency }}</span>
				</span>
				<input type="search" class="form-control col-3" 
				style="border-radius:25rem ;border-width:1px;" placeholder="search ....." v-model="query">
			</div>

			<div class="relative">
				<table class="table table-bordered table-sm table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th v-for="column in columns" v-text="column.label"
							 :class="column.cellClass">
							 </th>
						</tr>
					</thead>
					<tbody>
						<table-row
						v-for="(row,index) in results.collection"
						:key="index"
						:row="row"
						:columns="columns"
						>
						<!-- pass the current numbering to the table row -->
							{{ results.startingIndex+index }}.
						</table-row>
						<tr v-if="results.isEmpty" class="text-white bg-secondary text-center">
							<td :colspan="columns.length+1">
								No Items Were Found
							</td>
						</tr>
					</tbody>
					
				</table>
				<div class="vertically-centered bg-masked text-white" v-if="searchText">
					<h5>
						<span><i class="fa fa-spin fa-spinner"></i>  {{ searchText }} ............</span>
					</h5>
				</div>
			</div>
			<pagination-links :paginator="results"></pagination-links>
			<div style="display:none;">
				<slot></slot>
			</div>
		</div>
	</div>
</template>

<script>
	import {get,debounce} from "lodash";

	import Paginator from "./Paginator";

	import PaginationLinks from "./links";

	import TableRow from './tableRow';

	import Column from "./Column";

	import Row from "./Row";

	export default{

		components:{PaginationLinks,TableRow},

		props:{
			data:{required:true ,type:[Array,Object]},
		},


		data()
		{
			return {
				searchText:false,
				results:(new Paginator(this.data)),
				query:'',
				columns:[],
				rows:[],
				results:new Paginator(),
			}
		},
		mounted() {
			this.columns = this.$slots.default
			.filter(column => column.componentInstance)
			.map(column => new Column(column.componentInstance));

			this.mapDatatoRows();
		},
		methods:{
			mapDatatoRows()
			{
				this.rows= this.data.map(rowData => new Row(rowData, this.columns));
				this.results.items=this.rows;
			},
			search:debounce(function(){
				this.searchText=false;
				this.results.items=this.rows.filter(row => row.passesFilter(this.query));

			},300),

			changePerPage(event)
			{
				this.results.perPage=event.target.value;

			}
		},
		watch:{
			query(newValue)
			{
				if (!this.data.length) {
					return;
				}
				if (newValue) {
					this.searchText="Waiting for you to finish typing";
					this.search();
				}else{
					this.results.items=this.rows;
				}
			},
			data(newData)
			{
				this.mapDatatoRows();
			}
		}
	}
</script>
