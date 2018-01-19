
@inject('form', 'App\Forms\Product')
@extends('layouts.app')
    @section('content')
    <div class="col-md-8 mx-auto">
        <div class="card">
          <div class="card-body">
              <h4 class="card-title text-center">Register A new Product</h4>
              {{ $form->action(route('products.update',$product))->model($product)->method("PUT")}}
          </div>
        </div>
    </div>
         
    @endsection

