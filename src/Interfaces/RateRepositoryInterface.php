<?php

namespace Webeleven\Rateable\Interfaces;

interface RateRepositoryInterface
{
    public function save($data);

    public function update($rate_id, array $data = []);

    public function delete($rate_id);

    public function find($rate_id);
    
    public function getAll($limit = null, $start = 0);

    public function getAllByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0);

    public function getRatePointsDiscriminated($resource_id, $resource_type);

}