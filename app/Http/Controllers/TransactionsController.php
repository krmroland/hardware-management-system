<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transaction->loadDetails();

        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Transaction         $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            return tap($transaction)->delete();
        });
        flash('Transaction was removed successfully');

        return redirect()->route('home');
    }
}
