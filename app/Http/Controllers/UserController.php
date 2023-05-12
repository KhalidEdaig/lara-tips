<?php

namespace App\Http\Controllers;

use App\filters\UserFilters;
use App\Models\User;
use Illuminate\Support\Facades\Pipeline;

class UserController extends Controller
{
    public function __invoke()
    {
        return Pipeline::send(User::query())
            ->through(UserFilters::class)
            ->thenReturn()
            ->paginate();
    }
}
