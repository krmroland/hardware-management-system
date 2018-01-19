<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;

class ClientsController extends Controller
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
     * @param \App\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $client = $client->transactionDetails();

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $this->middleware('admin');

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Client              $client
     *
     * @return \App\Http\Requests\ClientRequest
     */
    public function update(ClientRequest $request, Client $client)
    {
        $this->middleware('admin');

        $client->update($request->only(['accountBalance', 'name', 'phoneNumber']));

        flash('Client was updated successfully');

        return redirect()->route('clients.show', $client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
    }
}
