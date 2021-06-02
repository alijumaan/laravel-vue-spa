<?php

namespace App\Http\Controllers\Api;

use App\Models\Period;

class PeriodController extends ApiController
{
    public function getPeriods()
    {
        $periods = Period::select('id', 'period')->get();

        return $this->respond([
            'periods' => $periods
        ]);
    }
}
