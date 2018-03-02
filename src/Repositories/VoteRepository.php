<?php

namespace Webeleven\Rateable\Repositories;

use Webeleven\Rateable\Interfaces\VoteRepositoryInterface;
use Webeleven\Rateable\Models\Comment;

class VoteRepository implements VoteRepositoryInterface
{

    public function increasePositiveVotes($comment_id)
    {
        return !! Comment::where('id', '=', $comment_id)->increment('positive_votes');
    }

    public function decreasePositiveVotes($comment_id)
    {
        return !! Comment::where('id', '=', $comment_id)->decrement('positive_votes');
    }

    public function increaseNegativeVotes($comment_id)
    {
        return !! Comment::where('id', '=', $comment_id)->increment('negative_votes');
    }

    public function decreaseNegativeVotes($comment_id)
    {
        return !! Comment::where('id', '=', $comment_id)->decrement('negative_votes');
    }
}