<div class="alert alert-secondary">
  <h5>  
      Made a {{$detail->actionName}} ( {{$product->bundle}})
      of
      <a href="{{ route('products.show',$product) }}">{{ $product->name }}</a>
      @if (isset($transaction) && $transaction)
      on 
      <a href="{{ route("transactions.show",$transaction) }}">
              {{ $transaction->date }}
      </a>
      @endif
    
      at
      {{ nf($product->buyingPrice,1) }} /=
      each
      {{ $product->unitName }}
      totaling up to
      {{ nf($detail->subTotal,1) }} /=
   </h5>
</div>
