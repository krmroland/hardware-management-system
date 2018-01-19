<?php

namespace App\Filters;

class EmployeeFilters extends BaseFilter
{
    public function searchable()
    {
        return [
        "name",
        "phoneNumber",
        "responsibility"
        ];
    }
}
