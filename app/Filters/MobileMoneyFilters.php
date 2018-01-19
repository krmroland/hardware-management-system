<?php

namespace App\Filters;

class MobileMoneyFilters extends BaseFilter
{
    public function searchable()
    {
        return [];
    }

    public function exact()
    {
        return ["type"];
    }

    public function miniHistory()
    {
        return $this->builder->latest()->limit(300);
    }
}
