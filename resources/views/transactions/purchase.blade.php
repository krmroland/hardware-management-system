@extends('layouts.app')
@section('content')
<div class="card col-md-11 mx-auto">
  <div class="card-body">
      <div class="level">
            <i></i>
          <h4 class="card-title text-center">
              Purchase Details for the date {{ $transaction->date }}
          </h4>
          <delete-button action="{{ route("transactions.destroy",$transaction) }}">
              
          </delete-button>
      </div>

      @foreach ($transaction->purchase as $purchase)
         @include('purchases.show')
      @endforeach


  </div>
</div>
@endsection
