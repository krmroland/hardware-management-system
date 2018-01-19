@extends('layouts.app')
    @section('content')
    <div class="card">
      <div class="card-body">
          <h4 class="card-title text-center"></h4>
          @include('transactions.item')
      </div>
    </div>
    @endsection

