@extends('layouts.app')
    @section('content')
     <div class="card">
       <div class="card-body">
          <div class="level">
                <div class="icon-medium icon-team"></div>
               <h4 class="card-title text-center">Customers List</h4>
               <a href="{{ route('customers.create') }}" class="btn btn-outline-secondary">
               <i class="fa fa-plus"></i>
                   Register New Customer
               </a>
          </div>
           <data-table :data="{{ $customers }}">
               <table-col label="Customers Name" data-key="name"></table-col>  
               <table-col label="Customers phone Number" data-key="phoneNumber"></table-col>  
               <table-col label="Account Balance" data-key="accountBalance"></table-col>  
               <table-col >
                  <template scope="row">
                       <a :href="'/customers/'+row.id">Details</a>
                  </template>
               </table-col>  
           </data-table>
       </div>
     </div>
    @endsection

