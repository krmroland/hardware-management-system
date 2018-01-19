
<div class="card mt-2">
  <div class="card-body">
      <div class="alert alert-secondary">
        <h5>  
            Made a payment 
            of
            ( {{nf($transaction->amount)}} /=)
            on
            {{ $transaction->date }}
         </h5>
      </div>
     
      @include('transactions.clientPayment',["payment"=>$payment]) 
  </div>
</div>

