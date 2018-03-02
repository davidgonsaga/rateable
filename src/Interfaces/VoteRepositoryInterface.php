<?php

namespace Webeleven\Rateable\Interfaces;

interface VoteRepositoryInterface
{

    public function increasePositiveVotes($comment_id);

    public function decreasePositiveVotes($comment_id);

    public function increaseNegativeVotes($comment_id);

    public function decreaseNegativeVotes($comment_id);

}