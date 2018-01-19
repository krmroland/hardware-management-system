<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Transaction;
use Illuminate\Http\Request;
use App\Products\ValidatesProductTransaction;

class SalesController extends Controller
{
    use ValidatesProductTransaction;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::summarizeAll();

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Transaction::initialData(new Sale());

        return view('sales.create', compact('data'));
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

        Transaction::makeASale();

        flash('sale was successful');

        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Sale $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sale $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sale                $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sale $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
    }
}
