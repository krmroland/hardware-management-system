@extends('layouts.app')
    @section('content')
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-between">
                    <h4 class="card-title text-center">Available Branches</h4>
                    <h5>
                      <small>  Total Branches:</small>
                       <strong> ({{ $branches->count() }})</strong>
                    </h5>
                    <a href="{{ route('branches.create') }}" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i>
                        New Branch
                    </a>
                </div>
        
            <hr>
             <data-table :data="{{ $branches }}">
                <table-col label="Branch Name" data-key="name" ></table-col> 
                <table-col label="Customers" data-key="customers_count" data-type="currency"></table-col> 
                <table-col label="Suppliers" data-key="suppliers_count" data-type="currency"></table-col> 
                <table-col label="Capital" data-key="capital" data-type="currency"></table-col> 
                <table-col label="Expected Cash" data-key="expectedCash" data-type="currency"></table-col> 
                <table-col label="Expected Profit" data-key="expectedProfit" data-type="currency"></table-col> 
                <table-col label="Details">
                    <template scope="branch">
                        <a :href="'/branches/'+branch.id">Details</a>
                    </template>
                </table-col>
             </data-table>

              </div>
            </div>
            {{-- @foreach ($branches as $branch)
                @include('branches.branch')
            @endforeach --}}
    @endsection

