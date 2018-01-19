@inject('form', 'App\SharedForms\Client')
@extends('layouts.app')
    @section('content')
            <div class="card">
              <div class="card-body">
                  <h4 class="card-title text-center">Register A new Supplier</h4>
                 {{ 
                     $form->fields(function($form){
                       $form->button()->text('Create A new Supplier');
                     })->action(route("suppliers.store"))
                  }}
              </div>
            </div>
    @endsection

