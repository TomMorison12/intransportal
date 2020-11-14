<?php

namespace App\Filters;

abstract class Filter
{
    protected $filters = [];

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        $this->getFilters()
            ->filter(function ($filter) {
                return method_exists($this, $filter);
            })->each(function ($filter, $value) {
                $this->$filter($value);
            });

        return $this->builder;
    }

    public function getFilters()
    {
        return collect($this->request->only($this->filters))->flip();
    }

    /**
     * @param $filter
     * @return bool
     */
}
