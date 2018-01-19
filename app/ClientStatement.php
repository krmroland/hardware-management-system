<?php

namespace App;

use PDF;

class ClientStatement
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function label()
    {
        return $this->client->name.' Financial Statement';
    }

    public function pdf()
    {
        return  PDF::loadView(
            'clients.statement',
            ['data' => $this]
        )->setPaper('a4', 'landscape')->stream();
    }

    public function client()
    {
        return $this->client;
    }

    public function clientAvatar()
    {
        return public_path($this->client->avatar);
    }

    public function transactions()
    {
        return $this->client->transactionDetails()->payments;
    }
}
