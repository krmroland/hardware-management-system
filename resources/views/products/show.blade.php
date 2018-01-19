@extends('layouts.app')
    @section('content')
            <div class="card">
              <div class="card-body">
                  <h4 class="card-title text-center">
                    ({{ optional($product->category)->name }}) {{ $product->name }}
                  </h4>
             {{--      @foreach ($product->adjustments as $adjustment)
                       {{ dd($adjustment) }}
                  @endforeach --}}
                  @forelse ($transactions as $transaction)
                    @include('transactions.item',['detail'=>$transaction])
                    @empty
                    <div class="alert alert-danger">
                      There are no product transactions
                    </div>
                  @endforelse
                  
              </div>
            </div>
    @endsection

