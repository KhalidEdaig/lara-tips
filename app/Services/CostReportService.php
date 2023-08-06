<?php

namespace App\Services;

use App\Models\CostRange;
use App\Models\Meter;
use Illuminate\Database\Eloquent\Collection;

class CostReportService
{


  public function eloquentMap(int $year, int $month): Collection
  {
    $reportList = Meter::with('user')
      ->where('year', $year)
      ->where('month', $month)
      ->orderBy('usage')
      ->limit(1000)
      ->get();

    $costs = CostRange::all();

    return $reportList->map(function (Meter $meter) use ($costs) {
      $pricing = $costs->where('from', '<=', $meter->usage)->where('to', '>=', $meter->usage)->first();

      if (!$pricing) {
        $pricing = $costs->where('from', '<=', $meter->usage)->whereNull('to')->first();
      }


      $meter->setAttribute('unit_price', $pricing->price);
      $meter->setAttribute('total_cost', $meter->usage * $pricing->price);

      return $meter;
    });
  }

  public function sqlMap(int $year, int $month): Collection
  {
    return Meter::with('user')
      ->where('year', $year)
      ->where('month', $month)
      ->addSelect([
        'unit_price' => fn ($query) => $query->from('cost_ranges')
          ->select('price')
          ->whereRaw('`from` <= meters.`usage` and `to` >= meters.`usage`')
          ->orWhereRaw('`from`<=meters.`usage` and `to` is null')
      ])
      ->selectRaw('user_id, `usage`, `usage` * (select unit_price) as total_cost')
      ->orderBy('usage')
      ->limit(1000)
      ->get();
  }
}
