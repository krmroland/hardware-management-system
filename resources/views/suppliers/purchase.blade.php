<div class="card mt-2">
  <div class="card-body">
      @include('suppliers.purchaseDescription',['purchase'=>$payment->payer,
        'transaction'=>$payment->payer->transaction])
      @include('purchases.supplierPayments',["purchase"=>$payment->payer])
  </div>
</div>
