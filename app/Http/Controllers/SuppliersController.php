<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Http\Requests\ClientRequest;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Supplier $supplier)
    {
        $suppliers = $supplier->getAll();

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
        Supplier::create($request->only('name', 'phoneNumber'));

        flash('supplier created success fully');

        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Supplier $supplier
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        $client = $supplier->transactionDetails();

        return view('clients.show', compact('client'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Supplier $supplier
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
    }
}
