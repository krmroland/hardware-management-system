<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class BaseFilter
{
    protected $dates = ['created_at', 'updated_at', 'date'];

    /**
     * @var Illuminate\Database\Query\Builder
     */
    protected $builder;
    /**
     * @var Illuminate\Http\Request
     */
    protected $request;

    protected $query;

    /**
     * creates an instance of this clss.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->query = $request->get('query');
    }

    /**
     * apply the filters.
     *
     * @param Builder $builder
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        $this->findExact()->search()->runCustomFilters();

        return $this->builder;
    }

    protected function findExact()
    {
        foreach ($this->getRequestedFields('exact') as $field) {
            if ($this->isAdate($field)) {
                $this->builder->whereDate("$field", $this->request->$field);
            } else {
                $this->builder->where("$field", $this->request->$field);
            }
        }

        return $this;
    }

    public function search()
    {
        if (!$this->isSearching()) {
            return $this;
        }

        foreach ($this->searchable() as $field) {
            $this->builder->orWhere("$field", 'like', "%$this->query%");
        }

        return $this;
    }

    public function runCustomFilters()
    {
        //we will trigger any custom filters than exist in the request and are  on the class
        foreach ($this->request->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }
    }

    protected function getRequestedFields()
    {
        return array_intersect($this->request->all(), $this->exact());
    }

    public function isAdate($field)
    {
        return in_array($field, $this->dates);
    }

    /**
     * Determines if searching.
     *
     * @return bool
     */
    public function isSearching()
    {
        return $this->request->has('query');
    }

    public function searchable()
    {
        return [];
    }

    public function exact()
    {
        return [];
    }
}
