<?php

namespace App\Filters\UserSearch\Filters;
use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class City implements Filter
{

    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->whereRaw('LOWER(city) LIKE ?', ['%'.Str::lower($value).'%']);
    }
}
