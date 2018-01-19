<template>
   <div class="w100 form-group">
        <slot name="label"></slot>
       <div class="input-group">
            <input type="search" class="form-control form-control-success" 
                    v-model="query" placeholder="search.......">
           <span class="input-group-addon">
               <i class="fa" :class="icon"></i>
           </span>
       </div>
        <div v-if="noMatches" class="text-info bg-faded text-center" style="padding:10px">
            <i class="fa fa-info"></i>
            No Matches found
        </div>
       <template v-else>
            <slot></slot>
       </template>
   </div>
</template>

<script>
import {get} from "lodash";
    export default
    {
        props:{
            originalData:{
                required:true,
                type:Array,

            },
            keys:{
                required:true,
                type:Array
            }
        },

        data(){
            return {
                query:'',
                icon:'fa-search',
                noMatches:false,
                results:null,
            }
        },
        watch:{
            query(newValue)
            {
                if (newValue) {
                    this.noMatches=false;
                    this.icon="fa-spinner fa-spin";
                    this.search();
                    return;
                }
                this.noMatches=false;
                return this.$emit("changed",this.originalData);
            },
            results(results)
            {
                if (!this.query) {
                    results=this.originalData;
                    this.noMatches=false;
                }
                if (_.isEmpty(results)) {
                    this.noMatches=true;
                }
               this.$emit("changed",results);

            },
            originalData(newData)
            {
                this.$emit("changed",newData);

            }
        },
        methods:{
            search:_.debounce(function(){

                this.results=this.filterResults(this.query);
                this.icon="fa-search";

            },250),
            filterResults()
            {
                return this.originalData.filter((item)=>{
                     return this.keys.filter((key)=>{ 
                        return String(get(item,key)).toLowerCase().includes(this.query);
                     }).length;
                });
            }

        }
    }
</script>
