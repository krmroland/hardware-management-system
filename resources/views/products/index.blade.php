@extends('layouts.app')
    @section('content')
            <div class="card">
              <div class="card-body">
                  <div class="level">
                    <div class="icon-medium icon-shopping-basket"></div>
                      <h4 class="card-title text-center">Registered Products</h4>
                      <a href="{{ route('products.create') }}" class="btn btn-outline-secondary">
                          <i class="fa fa-shopping-basket"></i>
                          Register A new Product
                      </a>
                  </div>
                  
              </div>
            </div>
            <data-table :data="{{ $products }}">
                <table-col label="Category" data-key="category.name"></table-col>
                <table-col label="Name" data-key="name"></table-col>
                <table-col label="Qty Available" data-key="bundle.name"></table-col>
            
                <table-col>
                  <template scope="row">

                  <a :href="'/products/'+row.id">
                      <i class="fa fa-info "></i>
                      Details
                  </a>
                  </template>
                </table-col>
                <table-col>
                  <template scope="row">
                    <a :href="'/products/'+row.id+'/edit'">
                      <i class="fa fa-edit"></i>
                      Edit
                    </a>
                  </template>
                </table-col>
            </data-table>
    @endsection

