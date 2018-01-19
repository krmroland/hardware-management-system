<?php

namespace App\Filters;

trait IsFilterable
{
    public function scopefilter($builder, BaseFilter $filters)
    {
        return $filters->apply($builder);
    }
}
