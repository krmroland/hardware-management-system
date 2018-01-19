@extends('layouts.app')
    @section('content')
         <div class="card mt-3">
           <div class="card-body">
             <h4 class="text-center mb-0">{{ $branch->name }}</h4>
             <hr>
             <div class="d-flex justify-content-between align-items-center flex-wrap text-center">
              <h4 class="mx-auto">
                  <small>Customers</small>
                  <strong>({{ nf($branch->customers_count) }})</strong>
              </h4>
              <h4 class="mx-auto">
                  <small>Suppliers</small>
                  <strong>({{ nf($branch->suppliers_count) }})</strong>
              </h4>
              <h4 class="mx-auto">
                  <small>Products</small>
                  <strong>({{ nf($branch->products_count) }})</strong>
              </h4>

              <h4 class="mx-auto">
                  <small>Capital</small>
                  <strong>({{ nf($branch->capital) }})</strong>
              </h4>

              <h4 class="mx-auto">
                  <small>Expected Cash</small>
                  <strong>({{ nf($branch->expectedCash) }})</strong>
              </h4>
              <h4 class="mx-auto">
                  <small>Expected Profit</small>
                  <strong>({{ nf($branch->expectedProfit) }})</strong>
              </h4>
          </div>
         </div>
      
         <branch-users :branch="{{ $branch }}" :all-users="{{ App\User::all() }}"></branch-users>

         </div>
    @endsection

