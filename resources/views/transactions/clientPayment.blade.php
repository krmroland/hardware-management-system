@if (!$payment)
    <div class="alert alert-danger">
        No Payment details recorded was made
    </div>
@else
<div class="mt-3">
  <h5 class="text-primary text-center">Balance Log</h5>
    <table class="table table-bordered table-sm">
      <thead>
          <tr>
              <th>Balance Before</th>
              <th>Supposed To Pay</th>
              <th>Amount Paid</th>
              <th>Balance After</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>{{ nf($payment->balanceBefore,1) }}</td>
              <td>{{ isset($supposedToPay)?nf($supposedToPay,1):' -----' }}</td>
              <td>{{ nf($payment->paid,1) }}</td>
              <td>{{ nf($payment->balanceAfter,1) }}</td>
          </tr>
      </tbody>
  </table>
  
</div>
     
@endif
