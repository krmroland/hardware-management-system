<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiptsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('receipt')) {
            $transaction = \DB::table('trades')->where([
                'receipt' => $request->receipt,
                'branch_id' => auth()->user()->activeBranch()->id,
            ])->first();

            return $transaction ?
                    $this->existingTransaction($transaction) :
                    $this->missingTransaction($request->receipt);
        }

        return view('receipts.index');
    }

    public function showTransaction()
    {
    }

    protected function missingTransaction($receipt)
    {
        flash("Receipt Number $receipt not found ", 'danger');

        return back();
    }

    protected function existingTransaction($transaction)
    {
        $detail = resolve($transaction->type)->fill((array) $transaction);

        return view('transactions.receiptDetail', compact('detail'));
    }
}
