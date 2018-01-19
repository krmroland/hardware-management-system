@extends('layouts.app')
@section('content')


@include('clients.client')

<div class="card mt-2">

  <div class="card-body">
    <h4 class="card-title text-center">Make A {{ $client->label }} Payment</h4>
    {{ 
      Form::fields(function($form){
        $form->dateField()->label("Date")->wrapperClass('col-md-6');
        $form->numberField()->name("amount")->wrapperClass("col-md-6")->label("Amount ");
        $form->button()->text("Make A Payment")->wrapperClass("col-md-6")->icon("fa fa-money");
      })->class("row")
      ->action(route('clients.payments.store',$client))
    }}

  </div>
</div>

@endsection

