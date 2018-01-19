@extends('layouts.app')
@section('content')

@include('clients.client',["readOnly"=>true])
<div class="btn-group justify-content-end d-flex mt-2">
  <a class="btn btn-success" href="{{ route('statement.show',$client) }}" 
 target="_blank">
 <i class="fa fa-file-pdf-o">
   Generate A Pdf Statement
 </i>
</a>
@if (auth()->user()->isAdmin())
  <a class="btn btn-secondary" href="{{ route('clients.edit',$client) }}" >
    <i class="fa fa-edit">
    Edit 
    </i>
    </a>
@endif
  
<a class="btn btn-primary"
href="{{ route('clients.payments.create',$client) }}">
<i class="fa fa-money">
  Pay A debt
</i>
</a>
</div>


@forelse ($client->payments as $payment)
@include("clients.".$payment->payer->actionName."Description",
["transaction"=>$payment->payer])

@empty
<div class="card mt-2">
  <div class="card-body">
   <div class="alert alert-info text-center"> 
     <strong>No Transactions Here</strong> 
   </div>

 </div>
</div>

@endforelse
@endsection

