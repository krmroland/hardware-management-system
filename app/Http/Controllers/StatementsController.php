<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientStatement;

class StatementsController extends Controller
{
    public function show(Client $client)
    {
        return (new ClientStatement($client))->pdf();
    }
}
