 <hr>
 <div class="mt-2">
  {{-- <div class="card-body"> --}}
  
  
  @include('transactions.description',['product'=>$detail->productAdjustment->new])


  @include('transactions.productAdjustments',
      ["adjustment"=>$detail->productAdjustment ,"transaction"=>$detail]
    )
 
  
  
  <h5 class="text-center text-muted">{{ucfirst($detail->clientLabel) }} Payment</h5>

  @include("clients.client", ['client' => $detail->client])
  @include('transactions.clientPayment',["payment"=>$detail->payment,"supposedToPay"=>$detail->subTotal])

</div>
