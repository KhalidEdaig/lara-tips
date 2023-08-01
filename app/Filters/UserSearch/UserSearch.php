<?php

namespace App\Filters\UserSearch;

use App\Filters\ModelSearch;
use App\Models\User;
use Illuminate\Http\Request;

class UserSearch
{

    public static function apply(Request $filters, $isPaginate = false)
    {
        return (new ModelSearch($filters, new User(), __NAMESPACE__, $isPaginate))->apply();
    }
}
