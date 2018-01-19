{{--  <div class="card mt-2">
  <div class="card-body">
    <h2 class="text-center text-primary d-flex align-items-center justify-content-center">
      {{ $detail->product->name }}
      ( <a href="{{ route('products.show',$detail->product) }}" class="font-size-1 text-muted">
      <span class="small">click for details</span>
    </a>)
  </h2>
  @include('transactions.description',['product'=>$detail->expressedAsProduct()])
  @include('transactions.productAdjustments')
 
  
  
  <h5 class="text-center text-muted">{{ strtoupper($detail->clientLabel) }} Payment</h5>

  @include("transactions.client", ['client' => $detail->client])
  @include('purchases.clientPayments',["payment"=>$detail->payment,"detail"=>$detail])
</div>
</div> --}}
