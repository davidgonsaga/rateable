<?php

namespace Webeleven\Rateable\Services;

use Webeleven\Rateable\Interfaces\VoteRepositoryInterface;

class VoteService
{

    private $voteRepository;

    public function __construct(VoteRepositoryInterface $voteRepository)
    {
        $this->voteRepository = $voteRepository;
    }

    public function increasePositiveVotes($comment_id)
    {
        return $this->voteRepository->increasePositiveVotes($comment_id);
    }

    public function decreasePositiveVotes($comment_id)
    {
        return $this->voteRepository->decreasePositiveVotes($comment_id);
    }

    public function increaseNegativeVotes($comment_id)
    {
        return $this->voteRepository->increaseNegativeVotes($comment_id);
    }

    public function decreaseNegativeVotes($comment_id)
    {
        return $this->voteRepository->decreaseNegativeVotes($comment_id);
    }
}