<?php

namespace App\Filters;

class StudentFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['name', 'isActive', 'gender', 'class', 'district'];

    /**
     * filter the results by the given na,e.
     *
     * @param string $name
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected function name($name)
    {
        $name = strtolower($name);

        return $this->builder->where('students.name', 'like', "%$name%");
    }

    /**
     * Filter the query according to the selected type.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function isActive($status)
    {
        return ($status == 0 || $status == 1 || is_bool($status)) ? $this->builder->activated($status) : $this->builder;
    }

    /**
     * Filter the query according to the selected gender.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function gender($gender)
    {
        return $this->builder->where(compact('gender'));
    }

    /**
     * filter the query according to th selected class.
     *
     *@param int $class_id
     *
     * @return \Illuminate\Database\Eloquent\BuilderBuilder
     */
    public function class($current_class)
    {
        return $this->builder->where(compact('current_class'));
    }

    /**
     * filter the query according to the selected district.
     *
     * @param string $district
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function district($district)
    {
        return $this->builder->where(compact('district'));
    }
}
