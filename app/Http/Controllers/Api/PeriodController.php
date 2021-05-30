<?php

namespace App\Http\Controllers\Api;

use App\Models\Period;

class PeriodController extends ApiController
{
    public function getPeriods()
    {
        $periods = Period::all();

        return [
            'periods' => $periods
        ];
    }
}
