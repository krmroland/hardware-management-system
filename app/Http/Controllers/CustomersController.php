<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        $customers = $customer->getAll();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        Customer::Create($request->all());

        flash('Customer created success fully');

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Customer $customer
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $client = $customer->transactionDetails();

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Customer $customer
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer            $customer
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Customer $customer
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
    }
}
