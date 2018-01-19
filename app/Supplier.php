<?php

namespace App;

class Supplier extends Client
{
    /**
     * gets the route name of the supplier.
     *
     * @return string
     */
    public function routeName()
    {
        return 'suppliers.show';
    }
}
