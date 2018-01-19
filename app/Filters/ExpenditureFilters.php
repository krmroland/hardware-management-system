<?php

namespace App\Filters;

class ExpenditureFilters extends BaseFilter
{
    public function searchable()
    {
        return [
        "ammount",
        "description",
        "category",
        "type"
        ];
    }

    public function dates()
    {
        return ["date"];
    }
}
