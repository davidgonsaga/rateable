<?php

namespace Webeleven\Rateable\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Webeleven\Rateable\Services\Calculator\RateAverageCalculator;
use Webeleven\Rateable\Services\RateService;

class RateAverageController extends Controller
{
    private $rateService;

    private $averageCalculator;

    public function __construct(RateService $rateService, RateAverageCalculator $averageCalculator)
    {
        $this->rateService = $rateService;
        $this->averageCalculator = $averageCalculator;
    }

    public function getOfAllRates()
    {
        $rates = $this->rateService->getAll();

        return Response::json($this->averageCalculator->getAverageRate($rates));
    }

    public function getByResourceIdAndType($resource_id, $resource_type)
    {
        $rates = $this->rateService->getAllByResourceIdAndType($resource_id, $resource_type);
        
        return Response::json($this->averageCalculator->getAverageRate($rates));
    }
}