<?php

namespace Webeleven\Rateable\Services;

use Webeleven\Rateable\Interfaces\RateRepositoryInterface;
use Webeleven\Rateable\Interfaces\RatingOwner;
use Webeleven\Rateable\Interfaces\UserProvider;

class RateService
{

    private $rateRepository;

    private $userProvider;

    public function __construct(RateRepositoryInterface $rateRepository, UserProvider $userProvider)
    {
        $this->rateRepository = $rateRepository;
        $this->userProvider = $userProvider;
    }

    public function save($data)
    {
        if (! $this->hasOwner($data)) {
            $data = $this->applyOwnerData($data);
        }

        return $this->rateRepository->save($data);
    }

    private function hasOwner(array $data)
    {
        return isset($data['owner_id']) || isset($data['owner_name']) || isset($data['owner_email']);
    }

    private function applyOwnerData($data)
    {
        $user = $this->userProvider->getUser();

        if (! $user instanceof RatingOwner) {
            throw new \Exception('User must implement RatingOwner interface');
        }

        $data['owner_id'] = ($user) ? $user->getId() : '';
        $data['owner_name'] = ($user) ? $user->getName() : 'Anônimo';
        $data['owner_email'] = ($user) ? $user->getEmail() : '';

        return $data;
    }

    public function update($rate_id, array $data = [])
    {
        return $this->rateRepository->update($rate_id, $data);
    }

    public function delete($rate_id)
    {
        return $this->rateRepository->delete($rate_id);
    }

    public function find($rate_id)
    {
        return $this->rateRepository->find($rate_id);
    }

    public function getAll($limit = null, $skip = 0)
    {
        return $this->rateRepository->getAll($limit, $skip);
    }

    public function getAllByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0)
    {
        return $this->rateRepository->getAllByResourceIdAndType($resource_id, $resource_type, $limit, $skip);
    }

    public function getRatePointsDiscriminated($resource_id, $resource_type)
    {
        return $this->rateRepository->getRatePointsDiscriminated($resource_id, $resource_type);
    }
}