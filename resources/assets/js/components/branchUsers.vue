<template>
    <div>
        <hr>
        <div class="level mx-2 px-2">
            <div class="icon-small icon-team"></div>
            <h5 class="text-center text-primary"> Branch Users</h5>
            <button class="btn btn-outline-primary" @click="addingUser=true" v-if="!addingUser">
                <i class="fa fa-user-plus"></i>
                Add New User
            </button>  
            <div v-else>
               <div class="input-group">
                    <select class="form-control" v-model="selectedUser">
                       <option value="" >Please Select a ...</option>
                       <option :value="user" v-for="user in allUsers">
                           {{ user.name }} ({{ user.phoneNumber }})
                       </option>
                   </select>
                   <button class=" btn btn-outline-primary" title="Save" @click="addUser" 
                    :disabled="!selectedUser">
                       <i class="fa fa-save"></i>
                   </button>
                   <button class="btn btn-outline-secondary" title="Cancel" @click="addingUser=false">
                       <i class="fa fa-times"></i>
                   </button>
               </div>
            </div>  
        </div>

    <data-table :data="users">
      <table-col label="Users Name" data-key="name"></table-col>  
      <table-col label="Phone Number" data-key="phoneNumber"></table-col>  
      <table-col label="Email" data-key="email"></table-col>  
      <table-col >
       <template scope="row">
        <a href="#" @click.prevent="removeUser(row)">Remove</a>
    </template>
</table-col>  
</data-table>  
</div>

</template>

<script>
export default
{
    props:["branch","allUsers"],

    data(){
        return {
            users:this.branch.users,
            addingUser:false,
            selectedUser:'',
        }
    },
    computed:{
        action(){
            return "/branches/"+this.branch.id+"/"
        }
    },
    methods:{
        addUser(){
            axios.post("/branches/"+this.branch.id+"/user",{user_id:this.selectedUser.id})
                 .then(({data})=>{
                flash("User was added successfully");
                this.users=data;
            }).catch(errors=>{
                flash("Something Went wrong.. May be the user already exist" ,'danger');
            })
        },
        removeUser(user){
            Confirmation.confirm("User will be detached from branch").then(confirmed=>{
                axios.delete(this.makeUrl(user)).then(removed=>{
                    flash("User detached success fully");
                    this.deleteUser(user);
                }).catch(failed=>flash("something went wrong",'danger'))
            })
        },
        makeUrl(user){
            return "/branches/"+this.branch.id+"/user/"+user.id;
        },
        deleteUser(deletedUser){
          const index=  this.users.findIndex((user)=>{
            return deletedUser.id==user.id;
        });

          this.users.splice(index, 1);
      }
  }
}
</script>
