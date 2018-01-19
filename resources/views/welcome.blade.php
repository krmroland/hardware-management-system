@inject('dashboard', 'App\Dashboard')
@extends('layouts.app')
@section('content')
<div class="row">
 @foreach ($dashboard->menu()  as $item)
 <div class="col-md-4">
  <hoverable>
    <div class="card mt-1">
     <div class="card-body">
       <h4 class="card-title text-center h4">
         <a href="{{ $item["href"] }}" >{{ $item["label"] }}</a>
       </h4>
       <div class="icon-medium {{ $item["icon"] }}" ></div>
     </div>
   </div>
 </hoverable>
</div>
@endforeach
</div>
@endsection

