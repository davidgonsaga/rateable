<?php

namespace Webeleven\Rateable\Repositories;

use Illuminate\Support\Facades\DB;
use Webeleven\Rateable\Models\Rate;
use Webeleven\Rateable\Interfaces\RateRepositoryInterface;

class RateRepository extends BaseRepository implements RateRepositoryInterface
{
    public function save($data)
    {
        return Rate::create($data);
    }

    public function update($rate_id, array $data = [])
    {
        return !! Rate::where('id', '=', $rate_id)->update($data);
    }

    public function delete($rate_id)
    {
        return !! Rate::where('id', '=', $rate_id)->delete();
    }

    public function find($rate_id)
    {
        return Rate::find($rate_id);
    }

    public function getAll($limit = null, $skip = 0)
    {
        $query = Rate::query();

        $query = $this->applyLimitAndOffsetIfNecessary($query, $limit, $skip);

        return $query->get();
    }

    public function getAllByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0)
    {
        $query = Rate::where('resource_id', '=', $resource_id)
                     ->where('resource_type', '=', $resource_type);

        $query = $this->applyLimitAndOffsetIfNecessary($query, $limit, $skip);

        return $query->get();
    }

    public function getRatePointsDiscriminated($resource_id, $resource_type)
    {
        return Rate::select(DB::raw('rating, COUNT(id) AS quantity'))
                   ->where('resource_id', '=', $resource_id)
                   ->where('resource_type', '=', $resource_type)
                   ->groupBy('rating')->get();
    }
}