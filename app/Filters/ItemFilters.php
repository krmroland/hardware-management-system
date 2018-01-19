<?php

namespace App\Filters;

class ItemFilters extends BaseFilter
{
    public function searchable()
    {
        return ["name","unitName","bundleName"];
    }
}
