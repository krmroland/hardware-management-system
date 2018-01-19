<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Transaction;
use Illuminate\Http\Request;
use App\Products\ValidatesProductTransaction;

class PurchasesController extends Controller
{
    use ValidatesProductTransaction;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::summarizeAll();

        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Transaction::initialData(new Purchase());

        return view('purchases.create', compact('data'));
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
        $this->validateData($request);

        Transaction::makeAPurchase();

        flash('Purchase was successful');

        return redirect()->route('purchases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Purchase $purchase
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        Purchase::with();

        return $this->hasMany(Purchase::class, 'transaction_id')
                    ->with(['supplierPayment.payee', 'productAdjustment']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Purchase $purchase
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Purchase            $purchase
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Purchase $purchase
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
    }
}
