@extends('layouts.app')
@section('content')
<div class="card">
  <div class="card-body">
      <div class="level">
        <i></i>
        <h4 class="card-title text-center">
          {{ title_case($transaction->actionName) }} Details for the date {{ $transaction->date }}
      </h4>
      <delete-button action="{{ route('transactions.destroy',$transaction) }}"> </delete-button>
  </div>

  @foreach ($transaction->items as $item)
        @include('transactions.item',['detail'=>$item->detail])
  @endforeach


</div>
</div>
@endsection

