<?php

namespace Webeleven\Rateable\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Webeleven\Rateable\Models\VoteStatus;
use Webeleven\Rateable\Services\CommentService;

class CommentController extends BaseController
{

    private $commentService;

    public function __construct(CommentService $commentService)
    {

        $this->commentService = $commentService;
    }

    public function save(Request $request)
    {
        try {

            $data = $request->all();

            return Response::json($this->commentService->save($data));

        } catch (\Exception $e) {

            return Response::json([
                'message' => $e->getMessage()
            ]);

        }
    }

    public function find($comment_id)
    {
        $comment = $this->commentService->find($comment_id);
        $comment = $this->applyCommentVoteStatus($comment);

        return Response::json([
            'comment' => $comment
        ]);
    }

    public function getAll(Request $request)
    {
        $data = $request->all();

        $limit = $this->getLimit($data);
        $skip = $this->getSkip($data);

        $comments = $this->commentService->getAll($limit, $skip);

        return Response::json([
            'comments' => $comments,
            'total' => count($comments)
        ]);
    }

    public function getAllByResourceIdAndType($resource_id, $resource_type, Request $request)
    {
        $data = $request->all();

        $limit = $this->getLimit($data);
        $skip = $this->getSkip($data);

        $comments = $this->commentService->getAllByResourceIdAndType($resource_id, $resource_type, $limit, $skip);

        return Response::json([
            'comments' => $comments,
            'total' => count($comments)
        ]);
    }

    public function getPublishedByResourceIdAndType($resource_id, $resource_type, Request $request)
    {
        $data = $request->all();

        $limit = $this->getLimit($data);
        $skip = $this->getSkip($data);

        $comments = $this->commentService->getPublishedByResourceIdAndType($resource_id, $resource_type, $limit, $skip);
        $comments = $this->applyCommentVoteStatus($comments);

        return Response::json([
            'comments' => $comments,
            'total' => count($comments)
        ]);
    }

    public function getUnpublishedByResourceIdAndType($resource_id, $resource_type, Request $request)
    {
        $data = $request->all();

        $limit = $this->getLimit($data);
        $skip = $this->getSkip($data);

        $comments = $this->commentService->getUnpublishedByResourceIdAndType($resource_id, $resource_type, $limit, $skip);

        return Response::json([
            'comments' => $comments,
            'total' => count($comments)
        ]);
    }

    private function applyCommentVoteStatus($comments)
    {
        foreach ($comments as $comment) {
            if (Cookie::get($comment->id . '_positive_vote')) {
                $comment->voted = VoteStatus::POSITIVE_VOTED;
            } else if (Cookie::get($comment->id . '_negative_vote')) {
                $comment->voted = VoteStatus::NEGATIVE_VOTED;
            } else {
                $comment->voted = VoteStatus::NOT_VOTED;
            }
        }

        return $comments;
    }

}