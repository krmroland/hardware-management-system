

@if($client)
<div>
  <div class="card">
    <div class="card-body level p-2">
        <img src="{{ $client->avatar }}" alt="" width="70">
        <h4 class="text-primary">{{ $client->name }}</h4>
        <h4 class="text-muted">
            <i class="fa fa-phone"></i>
            {{ $client->phoneNumber }}
        </h4>
        <h4 class=" text-primary">
          <span  class="small text-muted">Ac Bal (cuurent)</span>
          ({{ nf($client->accountBalance,1) }})
      </h4>
      @if(!isset($readOnly))
          <a href="{{ $client->routePath }}">Details</a>
      @endif
      
  </div>
  </div>
</div>
@endif
