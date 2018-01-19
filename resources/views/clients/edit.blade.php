@inject('form', 'App\SharedForms\Client')
@extends('layouts.app')
    @section('content')
            <div class="card">
              <div class="card-body">
                  <h4 class="card-title text-center">Register A new Supplier</h4>
                 {{ 
                     $form->model($client)->fields(function($form){
                        $form->numberField()->label("AccountBalance")->name("accountBalance")->step(0.5);
                        $form->button()->text('Edit Suppliers Profile');

                     })->action(route("clients.update",$client))->method("PUT")
                  }}
              </div>
            </div>
    @endsection

    
