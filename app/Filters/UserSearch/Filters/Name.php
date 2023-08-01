<?php

namespace App\Filters\UserSearch\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Filters\Filter;

class Name implements Filter
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
        return $builder->whereRaw('LOWER(name) like ?', ['%' . Str::lower($value) . '%']);
    }
}
