<?php

namespace App\filters;

use Closure;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;


class UserFilters
{
 public function __construct(protected Request $request)
 {
 }

 public function handle(Builder $builder, Closure $next)
 {
  return $next($builder)
   ->when($this->request->has('name'), fn ($query) => $query->where('name', 'REGEXP', $this->request->name))
   ->when($this->request->has('email'), fn ($query) => $query->where('email', 'REGEXP', $this->request->email))
   ->when($this->request->has('bod'), fn ($query) => $query->where('bod', 'REGEXP', $this->request->bod));
 }
}
