<?php

use App\Exports\ReportExport;
use App\Exports\UsersExport;
use App\Http\Controllers\CostReportController;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('{any}', function () {
    return view('layouts.default');
})->where('any','.*');

Route::get('email', function () {
    return view('emails.subscription-expiration');
});

Route::get('report', CostReportController::class);

Route::get('three-way-to-get-last-inserted-id', function () {
    echo "Method 1: Retrieving Insert ID Using Model::create" . PHP_EOL;
    $cins = ["QA123214", "FB122134", "FB00000"];
    $user = User::create([
        'name'                  => fake()->name(),
        'email'                 => fake()->unique()->safeEmail(),
        'bod'                   => fake()->date(),
        'age'                   => fake()->randomNumber(),
        'city'                  => fake()->name(),
        'company'               => fake()->name(),
        'amount'                => fake()->randomDigit(),
        'cin'                   => $cins[array_rand($cins, 1)],
        'email_verified_at'     => now(),
        'password'              => 'password',
        'remember_token'        => str()->random(10),
    ]);

    echo $user->id . PHP_EOL;

    echo "Method 2: Retrieving Insert ID Using new Model() and save()" . PHP_EOL;
    $user = new User();
    $user->name                  = fake()->name();
    $user->email                 = fake()->unique()->safeEmail();
    $user->bod                   = fake()->date();
    $user->age                   = fake()->randomNumber();
    $user->city                  = fake()->name();
    $user->company               = fake()->name();
    $user->amount                = fake()->randomDigit();
    $user->cin                   = $cins[array_rand($cins, 1)];
    $user->email_verified_at     = now();
    $user->password              = 'password';
    $user->remember_token        = str()->random(10);
    $user->save();
    echo $user->id . PHP_EOL;
});


Route::get('export', fn () =>  Excel::download(new ReportExport('test',now()->format('h:m:s'),now()->format('Y-m-d')), 'userexport.xlsx'));

Route::get('test', function () {
    $refunds = Refund::with(['dossier','consumer','optician'])
    ->get();

    return view('welcome',with(['collection'=>$refunds]));
});
