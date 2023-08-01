<?php

namespace App\Filters\UserSearch\Filters;
use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Event implements Filter
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
        return $builder->whereHas('rsvps.event', function ($q) use ($value) {
           $q->whereRaw('LOWER(events.name) LIKE ?', ['%'.Str::lower($value).'%']);
        });
    }
}