<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * The Eloquent builder.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [];

    protected $customAdded = [];

    /**
     * Create a new ThreadFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        $this->flashInput();

        return $this->builder;
    }

    /**
     * Fetch all relevant filters to apply.
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = $this->request->only($this->filters) + $this->customAdded;

        return array_filter($filters, function ($value) {
            return $value != null;
        });
    }

    public function add($filters)
    {
        $this->customAdded = $filters;

        return $this;
    }

    protected function flashInput()
    {
        if (count($this->request->all())) {
            session()->flashInput($this->request->all());
        }
    }
}
