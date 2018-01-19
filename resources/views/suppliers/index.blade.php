@extends('layouts.app')
    @section('content')
     <div class="card">
       <div class="card-body">
          <div class="level">
                <div class="icon-medium icon-team"></div>
               <h4 class="card-title text-center">Suppliers List</h4>
               <a href="{{ route('suppliers.create') }}" class="btn btn-outline-secondary">
               <i class="fa fa-plus"></i>
                   Register New Supplier
               </a>
          </div>
           <data-table :data="{{ $suppliers }}">
               <table-col label="Suppliers Name" data-key="name"></table-col>  
               <table-col label="Suppliers phone Number" data-key="phoneNumber"></table-col>  
               <table-col label="Account Balance" data-key="accountBalance"></table-col>  
               <table-col >
                  <template scope="row">
                       <a :href="'/suppliers/'+row.id">Details</a>
                  </template>
               </table-col>  
           </data-table>
       </div>
     </div>
    @endsection

