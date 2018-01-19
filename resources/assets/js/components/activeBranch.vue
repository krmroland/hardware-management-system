<template>
   <select class="form-control" v-model="activeId">
       <option :value="branch.id" v-for="branch in all">{{ branch.name }}</option>
   </select>
</template>

<script>
    export default
    {
        props:["active","all","userId"],

        data(){
            return {
                  activeCopy:this.active
            }
        },
        computed:{
            activeId:{

                get(){
                    return this.activeCopy.id;
                },
                set(id){
                    this.all.map((branch)=>{
                        id==branch.id?this.activeCopy=branch:true;
                    });
                }
            }
        },
        watch:{
            activeCopy(branch){
                axios.put("/branches/"+branch.id+"/user/"+this.userId).then(done=>{
                    window.location="/";
                }).catch(failed=>{
                    window.location="/";
                });
            }
        }
    }
</script>
