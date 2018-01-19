<tr class="{{ isset($active)?"table-info":'' }}"> 
  <td>{{ $state }}</td>

  <td>
    {{ $product->availableQuantity}}
    ({{ $product->bundle }})
  </td>
  <td>{{ nf($product->buyingPrice,1) }}</td>
  <td>{{ nf($product->sellingPrice,1) }}</td>
</tr>
