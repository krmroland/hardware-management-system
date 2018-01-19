<?php

namespace App;

class Customer extends Client
{
    public function routeName()
    {
        return 'customers.show';
    }

    public function makePayment()
    {
    }
}
