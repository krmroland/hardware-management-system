@extends('layouts.app')
@section('content')
<div class="relative">
        <div class="card">
          <div class="card-body">
              <h4 class="card-title text-center">Find A Specific Receipt</h4>
            {{  Form::fields(function($form){
                $form->textField()->name("receipt")->label('Receipt Number');
                $form->button()->text("Load Receipt Details");
            })->method("get")
            }}
          </div>
      </div>
</div>

@endsection

