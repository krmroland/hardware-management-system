
@if($adjustment)
<div class="mt-4">
      <h4 class="text-center">Product Log</h4>
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th>State</th>
            <th>Available Quantity</th>
            <th>Buying Price</th>
            <th>Selling Price</th>
          </tr>
        </thead>
        <tbody>

         <!-- Product State Before Transaction -->
         @include('products.tableRow',
         ["product"=>$adjustment->before,'state'=>'Before'])
         <!-- product state transacted-->
         @include('products.tableRow',[
          'product'=>$adjustment->new,
          'state'=>$transaction->actionName,'active'=>true
          ])
         <!--  Product State After Transaction -->
         @include('products.tableRow',
         ["product"=>$adjustment->after,'state'=>'After'])
       </tbody>
      </table>
</div>
@endif
