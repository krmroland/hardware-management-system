
<div class="card mt-2">
  <div class="card-body">
      <h4 class="card-title text-center">{{ $transaction->date }}</h4>
      @include('transactions.description',[
          "transaction"=>$transaction,
          'product'=>$payment->payer->productAdjustment->new,
          'detail'=>$payment->payer
      ])
      @include('transactions.productAdjustments',
          ["adjustment"=>$payment->payer->productAdjustment]
        )
      @include('transactions.clientPayment',
        ["payment"=>$payment,"supposedToPay"=>$payment->payer->subTotal]) 
  </div>
</div>
