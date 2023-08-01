<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Facades\Response;
use App\Filters\UserFilters;
use App\Filters\UserSearch\UserSearch;
use App\Http\Resources\ApiPaginateResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pipeline;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\SimpleExcel\SimpleExcelWriter;

class UserController extends Controller
{
    public function __invoke()
    {

        // if(!Cache::has('users')){
        //     Cache::rememberForever('users',fn()=>User::all());
        // }

        // return Excel::download(new UsersExport(), 'userexport.csv');

        $writer = SimpleExcelWriter::streamDownload('users.csv');
        $query = User::orderBy('created_at');

        $i = 0;
        foreach ($query->lazy(1000) as $user) {
            $writer
            ->addHeader(['id', 'name','email'])
            ->addRow([
                $user->id,
                $user->name,
                $user->email
            ]);

            if ($i % 1000 === 0) {
                flush(); // Flush the buffer every 1000 rows
            }
            $i++;
        }

        return $writer->toBrowser();

        // $query=User::where('age','>',1000);

        // return Response::json([
        //     'results'=>$query->get(),
        //     'count'=>$query->count(),
        //     'sum_amount'=>$query->sum('amount')
        // ]);
        // return Response::json(new ApiPaginateResource(UserSearch::apply(request(), true)), 200);
        // return Pipeline::send(User::query())
        //     ->through(UserFilters::class)
        //     ->thenReturn()
        //     ->paginate()
        //     ->through(fn(User $user)=> $user->only(['name','email','cin']));

    }
}
