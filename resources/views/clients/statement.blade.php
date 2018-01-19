
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Statement</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #fff;
            background-image: none;
            font-size: 14px;
        }
        address{
            margin-top:15px;
        }
        h2 {
            font-size:28px;
            color:#cccccc;
        }
        .text-center{
            text-align: center !important;
        }
        .container {
            padding-top:30px;
        }
        .invoice-head td {
            padding: 0 8px;
        }
        .invoice-body{
            background-color:transparent;
        }
        .logo {
            padding-bottom: 10px;
        }
        .table {
          border-collapse: collapse !important;
        }
        .table td,
        .table th {
          background-color: #fff !important;
        }
        .table-bordered th,
        .table-bordered td {
          border: 1px solid #ddd !important;
        }
       
       .table {
         width: 100%;
         max-width: 100%;
         margin-bottom: 1rem;
         background-color: transparent;
       }

       .table th,
       .table td {
         padding: 0.75rem;
         vertical-align: top;
         border-top: 1px solid #e9ecef;
       }

       .table thead th {
         vertical-align: bottom;
         border-bottom: 2px solid #e9ecef;
       }

       .table tbody + tbody {
         border-top: 2px solid #e9ecef;
       }

       .table .table {
         background-color: #fff;
       }

       .table-sm th,
       .table-sm td {
         padding: 0.3rem;
       }

       .table-bordered {
         border: 1px solid #e9ecef;
       }

       .table-bordered th,
       .table-bordered td {
         border: 1px solid #e9ecef;
       }

       .table-bordered thead th,
       .table-bordered thead td {
         border-bottom-width: 2px;
       }


     
    img {
      vertical-align: middle;
      border-style: none;
    }
</style>
</head>

<body>
    <div class="container">
        <table style="margin-left: auto; margin-right: auto" width="550">
            <tr>
                <td width="160" style="font-size:28px;color:#cccccc;">
                    Statement
                </td>

                <!-- Organization Name / Image -->
                <td align="right">
                    <strong>{{ company()->get("name") }}</strong>
                </td>
            </tr>
            <tr valign="middle">
                <td>
                    <br><br>
                    <strong>For:</strong> {{ $data->client->name }}
                    <br><br>
                    <strong>Date:</strong> {{ date('d-m-Y') }}
                </td>
                <td>
                 <img src="{{ $data->clientAvatar() }}" alt="" style="width: 50px">
             </td>
         </tr>
     </table>
 </div>
 <div>
    <table class="table table-bordered table-sm">
        <thead>
         <tr>
             <th>#</th>
             <th>Date</th>
             <th>Opening</th>
             <th>Amount</th>
             <th>Supposed To Pay</th>
             <th>Closing</th>
             <th>Description</th>
         </tr> 
     </thead>
     <tbody>
         @forelse ($data->transactions() as $payment)
         <tr>
            <td>{{ ++$loop->index }}</td>
             <td>{{ $payment->payer->date }}</td>
             <td>{{ nf($payment->supposedToPay,1) }}</td>
             <td>{{ nf($payment->balanceBefore,1) }}</td>
             <td>{{ nf($payment->amount,1) }}</td>
             <td>{{ nf($payment->balanceAfter) }}</td>
             <td>{{ $payment->payer->description }}</td>
         </tr>


         @empty
         <tr >
             <td class="text-center" colspan="7"> No Transactions Here</td>
         </tr>

 @endforelse
</tbody>


</table>
</div>
</body>
</html>
