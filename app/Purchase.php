<?php

namespace App;

class Purchase extends Trade
{
    public function clientType()
    {
        return Supplier::class;
    }
}
