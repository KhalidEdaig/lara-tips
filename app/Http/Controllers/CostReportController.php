<?php

namespace App\Http\Controllers;

use App\Services\CostReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;

class CostReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $year = $request->input('year', now()->format('Y'));
        $month = $request->input('month', now()->format('m'));
        $service = new CostReportService();

        Benchmark::dd(
            [
                fn () => $service->eloquentMap($year, $month),
                fn () => $service->sqlMap($year, $month),
            ],
            10
        );

        //  $reportList = $service->eloquentMap($year, $month);
         $reportList = $service->sqlMap($year, $month);
        return view('report', compact('reportList'));
    }
}
