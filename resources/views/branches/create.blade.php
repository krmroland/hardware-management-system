@extends('layouts.app')
    @section('content')
            <div class="card ">
              <div class="card-body">
                  <h4 class="card-title text-center">Create A new Branch</h4>
                  {{ 
                    Form::fields(function($form){
                        $form->textField()->name("name")->label("The Name of the branch");
                        $form->button();
                        $form->action(route('branches.store'));
                    })
                   }}
              </div>
            </div>
    @endsection

