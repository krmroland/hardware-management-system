 <div class="card mt-2">
  <div class="card-body">
    <h2 class="text-center text-primary d-flex align-items-center justify-content-center">
      {{ $purchase->product->name }}
      ( <a href="{{ route('products.show',$purchase->product) }}" class="font-size-1 text-muted">
      <span class="small">click for details</span>
    </a>)
  </h2>
  @include('purchases.productAdjustments')
  @include('suppliers.purchaseDescription')
  <h5 class="text-center text-muted">Supplier Payment</h5>
  @includeWhen($purchase->supplierPayment,'suppliers.supplier',['supplier'=>$purchase->supplierPayment->payee])
  @include('purchases.supplierPayments',["payment"=>$purchase->supplierPayment,"purchase"=>$purchase])
</div>
</div>
