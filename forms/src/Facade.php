<?php

namespace Lawma\Forms;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return new Form();
    }
}
