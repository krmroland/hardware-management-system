
@inject('form', 'App\Forms\Product')
@extends('layouts.app')
    @section('content')
    <div class="mx-auto">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Register A new Product</h4>
              <div class="col-md-6 mx-auto">
              
                {{ $form->action(route('products.store'))}}
              </div>
              
          </div>
        </div>
    </div>
         
    @endsection

