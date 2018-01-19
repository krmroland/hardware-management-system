<template>
    <!-- Never render the contents -->
    <!-- The scoped slot won't have the required data -->
    <div v-if="false">
        <slot></slot>
    </div>
</template>

<script>

import numeral from "numeral";

    export default {
        props: {
            dataKey: { type: String },
            label: { default: null, type: String },
            dataType: { default: 'string', type: String },
            cellClass:{default:null},
            formatter: {
                default:function(value,dataType){
                    if (dataType=='currency') {
                        return numeral(value).format();
                    }
                    return value;
                }, 
                type: Function
              },

            hidden: { default: false, type: Boolean },
            filterable:{default:true,type:Boolean}
        },
        methods:
        {
            formatValue(value,dataType)
            {
                return value;
            }
        }
       
    };
</script>
