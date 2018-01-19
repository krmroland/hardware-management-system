@extends('layouts.app')
    @section('content')
           <div class="card col-md-8 mx-auto">
             <div class="card-body">
                 <h4 class="card-title text-center">Edit ({{ $supplier->name }}) Details</h4>
                 @include('clients.form')
                 
                 {{ $form->model($supplier)->method("put")->action(route("suppliers.update",$supplier)) }}
             </div>
           </div>
    @endsection

