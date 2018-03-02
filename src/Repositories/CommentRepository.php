<?php

namespace Webeleven\Rateable\Repositories;

use Illuminate\Support\Facades\DB;
use Webeleven\Rateable\Interfaces\CommentRepositoryInterface;
use Webeleven\Rateable\Models\Comment;
use Webeleven\Rateable\Models\CommentPublishStatus;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    public function save($data)
    {
        return Comment::create($data);
    }

    public function changePublishStatus($resource_id, $publish_status)
    {
        return Comment::where('id', '=', $resource_id)
            ->update([
                'published' => $publish_status
            ]);
    }

    public function delete($comment_id)
    {
        return Comment::find($comment_id)->delete();
    }

    public function find($comment_id)
    {
        return Comment::with('rate')->where('id', '=', $comment_id)->get();
    }

    public function getAll($limit = null, $skip = 0)
    {
        $query = Comment::with('rate');

        $query = $this->applyLimitAndOffsetIfNecessary($query, $limit, $skip);

        return $query->get();
    }

    public function getAllByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0)
    {
        $query = Comment::with('rate')->whereHas('rate', function($query) use($resource_id, $resource_type) {

            $query
                ->where('resource_id', '=', $resource_id)
                ->where('resource_type', '=', $resource_type);

        });

        $query = $this->applyLimitAndOffsetIfNecessary($query, $limit, $skip);

        return $query->get();
    }

    public function getPublishedByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0)
    {
        $query = Comment::with('rate')->whereHas('rate', function($query) use($resource_id, $resource_type) {

            $query
                ->where('resource_id', '=', $resource_id)
                ->where('resource_type', '=', $resource_type);

        })->where('published', CommentPublishStatus::PUBLISHED);

        $query = $this->applyLimitAndOffsetIfNecessary($query, $limit, $skip);

        return $query->get();
    }

    public function getUnpublishedByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0)
    {
        $query = Comment::with('rate')->whereHas('rate', function($query) use($resource_id, $resource_type) {

            $query
                ->where('resource_id', '=', $resource_id)
                ->where('resource_type', '=', $resource_type);

        })->where('published', CommentPublishStatus::NOT_PUBLISHED);

        $query = $this->applyLimitAndOffsetIfNecessary($query, $limit, $skip);

        return $query->get();
    }

}