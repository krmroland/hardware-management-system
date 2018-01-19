@inject('form', 'App\SharedForms\Client')
@extends('layouts.app')
    @section('content')
            <div class="card  mx-auto">
              <div class="card-body">
                  <h4 class="card-title text-center">Register A new Customer</h4>
                    {{ 
                        $form->fields(function($form){
                          $form->button()->text('Create A new Customer');
                        })->action(route("customers.store"))
                     }}
              </div>
            </div>
    @endsection

