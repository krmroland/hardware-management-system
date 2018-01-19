@extends('layouts.app')
    @section('content')
            <div class="card ">
              <div class="card-body">
                  <h4 class="card-title text-center">Create A new User</h4>
                  {{ 
                    Form::fields(function($form){
                        $form->textField()->name("name")->label("The Name of the User");
                        $form->textField()->name("email")->label("Users Email");
                        $form->textField()->name("phoneNumber")->label("Users Phone Number");
                        $form->radioField()->name("isAdmin")->choices(['No','Yes'])
                             ->label("Has Administrative Rights?")->hasKeys();

                        $form->button();
                        $form->action(route('users.store'));
                    })
                   }}
              </div>
            </div>
    @endsection

