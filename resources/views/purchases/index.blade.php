@extends('layouts.app')
    @section('content')
            <div class="card">
              <div class="card-body">
                  <div class="level">
                    <div class="icon-medium icon-shopping-basket"></div>
                      <h4 class="card-title text-center">Made Purchases</h4>
                      <a href="{{ route('purchases.create') }}" class="btn btn-outline-secondary">
                          <i class="fa fa-shopping-basket"></i>
                          Make A new Purchase
                      </a>
                  </div>
                  
              </div>
            </div>
            <data-table :data="{{ $purchases }}">
                <table-col label="Date" data-key="date"></table-col>
                <table-col label="Purchased Goods worth" data-type="currency" data-key="grossTotal"></table-col>
                <table-col label="And Paid A sum of" data-type="currency" data-key="total_paid"></table-col>
                <table-col label="details">
                  <template scope="row">
                    <a :href="'/transactions/'+row.id">Details</a>
                  </template>
                </table-col>
            </data-table>
    @endsection

