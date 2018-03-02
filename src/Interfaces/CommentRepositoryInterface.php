<?php

namespace Webeleven\Rateable\Interfaces;

interface CommentRepositoryInterface
{

    public function save($data);

    public function delete($comment_id);

    public function changePublishStatus($resource_id, $publish_status);

    public function find($comment_id);

    public function getAll($limit = null, $skip = 0);

    public function getAllByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0);

    public function getPublishedByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0);

    public function getUnpublishedByResourceIdAndType($resource_id, $resource_type, $limit = null, $skip = 0);

}