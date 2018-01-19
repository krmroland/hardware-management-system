<?php

namespace App;

class Sale extends Trade
{
    public function clientType()
    {
        return Customer::class;
    }
}
