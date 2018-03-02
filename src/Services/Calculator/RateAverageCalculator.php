<?php

namespace Webeleven\Rateable\Services\Calculator;

use Illuminate\Database\Eloquent\Collection;

class RateAverageCalculator
{
    private $totalPoints;

    private $numberOfRates;

    public function getAverageRate(Collection $rateCollection)
    {
        if ($rateCollection->isEmpty()) {
            return [
                'average' => 0,
                'total' => 0
            ];
        }

        $this->numberOfRates = $rateCollection->count();
        $this->totalPoints = $rateCollection->sum('rating');

        return [
            'average' => $this->calculateAverageRate(),
            'total' => $this->numberOfRates
        ];
    }

    protected function calculateAverageRate()
    {
        return round(($this->totalPoints / $this->numberOfRates) * 2) / 2;
    }
}