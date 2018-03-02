<?php

namespace Webeleven\Rateable\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Webeleven\Rateable\Models\RatePublishStatus;
use Webeleven\Rateable\Services\RateService;

class RateController extends BaseController
{

    private $rateService;

    public function __construct(RateService $rateService)
    {
        $this->rateService = $rateService;
    }

    public function save(Request $request)
    {
        try {

            $data = $request->all();

            return Response::json($this->rateService->save($data));

        } catch (\Exception $e) {

            return Response::json([
                'message' => $e->getMessage()
            ], 403);

        }
    }

    public function getAll(Request $request)
    {
        $data = $request->all();

        $limit = $this->getLimit($data);
        $skip = $this->getSkip($data);
        
        return Response::json($this->rateService->getAll($limit, $skip));
    }

    public function getAllByResourceIdAndType($resource_id, $resource_type, Request $request)
    {
        $data = $request->all();

        $limit = $this->getLimit($data);
        $skip = $this->getSkip($data);

        $rates = $this->rateService->getAllByResourceIdAndType($resource_id, $resource_type, $limit, $skip);

        return Response::json([
            'rates' => $rates,
            'total' => $rates->count()
        ]);
    }

    public function getRatePointsDiscriminated($resource_id, $resource_type)
    {
        $ratesDiscriminated = $this->rateService->getRatePointsDiscriminated($resource_id, $resource_type);

        return Response::json([
            'ratesDiscriminated' => $ratesDiscriminated,
            'total' => $ratesDiscriminated->sum('quantity')
        ]);
    }
}
