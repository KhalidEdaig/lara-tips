<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ModelSearch
{
    protected $filters;

    protected $model;

    protected $namespace;

    protected $isPaginate;

    public function __construct(Request $filters, $model, $namespace, $isPaginate = false)
    {
        $this->filters = $filters;
        $this->namespace = $namespace;
        $this->model = $model;
        $this->isPaginate = $isPaginate;
    }

    public function apply()
    {
        $query = self::applyDecoratorsFromRequest();

        return $this->isPaginate ? self::getResultsPaginate($query) : self::getResults($query);
    }

    private  function applyDecoratorsFromRequest()
    {
        $query = $this->model::query();
        foreach ($this->filters->all() as $filterName => $value) {

            $decorator = self::createFilterDecorator($filterName);

            if (self::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
        }
        return $query;
    }

    private  function createFilterDecorator($name)
    {
        return $this->namespace . '\\Filters\\' . Str::studly($name);
    }

    private  function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    private  function getResults(Builder $query)
    {
        return $query->get();
    }

    private  function getResultsPaginate(Builder $query)
    {
        return $query->paginate();
    }
}
