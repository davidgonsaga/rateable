<?php

namespace Webeleven\Rateable\Services;

use Webeleven\Rateable\Interfaces\CommentRepositoryInterface;
use Webeleven\Rateable\Models\CommentPublishStatus;

class CommentService
{

    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {

        $this->commentRepository = $commentRepository;

    }

    public function save(array $data = [])
    {
        return $this->commentRepository->save($data);
    }

    public function delete($comment_id)
    {
        return $this->commentRepository->delete($comment_id);
    }

    public function publish($comment_id)
    {
        try {

            return !! $this->commentRepository->changePublishStatus($comment_id, CommentPublishStatus::PUBLISHED);

        } catch (\Exception $e) {

            return $e->getMessage();

        }
    }

    public function unpublish($comment_id)
    {
        try {

            return !! $this->commentRepository->changePublishStatus($comment_id, CommentPublishStatus::NOT_PUBLISHED);

        } catch (\Exception $e) {

            return $e->getMessage();

        }
    }

    public function find($comment_id)
    {
        return $this->commentRepository->find($comment_id);
    }

    public function getAll($limit = null, $skip = 0)
    {
        return $this->commentRepository->getAll($limit, $skip);
    }

    public function getAllByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0)
    {
        return $this->commentRepository->getAllByResourceIdAndType($resource_id, $resource_type, $limit, $skip);
    }

    public function getPublishedByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0)
    {
        $comments = $this->commentRepository->getPublishedByResourceIdAndType($resource_id, $resource_type, $limit, $skip);

        return $comments;
    }

    public function getUnpublishedByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0)
    {
        return $this->commentRepository->getUnpublishedByResourceIdAndType($resource_id, $resource_type, $limit, $skip);
    }
}