<?php

namespace App\Http\Controllers;

use App\Client;
use App\Finance;
use Illuminate\Http\Request;

class ClientPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        return view('finances.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $data = $request->validate(['amount' => 'required|numeric', 'date' => 'required']);

        $client->handlePayment($data);

        return redirect()->route('clients.show', $client);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Finance $finance
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Finance $finance
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Finance $finance)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Finance             $finance
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finance $finance)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Finance $finance
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {
    }
}
