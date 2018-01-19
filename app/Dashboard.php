<?php

namespace App;

class Dashboard
{
    public function menu()
    {
        //tempolary
        return company()->get('menu');
    }
}
