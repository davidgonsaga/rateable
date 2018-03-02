<?php

namespace Webeleven\Rateable\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Webeleven\Rateable\Services\VoteService;

class VoteController extends Controller
{

    private $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function increasePositiveVotes($comment_id, Request $request)
    {
        $key = $comment_id . '_positive_vote';

        if (! $request->cookie($key)) {

            try {

                $this->voteService->increasePositiveVotes($comment_id);

                return Response::json([
                    'actionWasPerformed' => 1
                ])->withCookie(cookie()->forever($key, true));

            } catch (\Exception $e) {

                return Response::json([
                    'message' => $e->getMessage()
                ]);

            }
        }

        return Response::json([
            'actionWasPerformed' => 2
        ]);
    }

    public function decreasePositiveVotes($comment_id, Request $request)
    {
        $key = $comment_id . '_positive_vote';

        if ($request->cookie($key)) {

            try {

                $this->voteService->decreasePositiveVotes($comment_id);

                return Response::json([
                    'actionWasPerformed' => 1
                ])->withCookie(Cookie::forget($key));

            } catch (\Exception $e) {

                return Response::json([
                    'message' => $e->getMessage()
                ]);

            }
        }

        return Response::json([
            'actionWasPerformed' => 2
        ]);
    }

    public function increaseNegativeVotes($comment_id, Request $request)
    {
        $key = $comment_id . '_negative_vote';

        if (! $request->cookie($key)) {

            try {

                $this->voteService->increaseNegativeVotes($comment_id);

                return Response::json([
                    'actionWasPerformed' => 1
                ])->withCookie(cookie()->forever($key, true));

            } catch (\Exception $e) {

                return Response::json([
                    'message' => $e->getMessage()
                ]);

            }
        }

        return Response::json([
            'actionWasPerformed' => 2
        ]);
    }

    public function decreaseNegativeVotes($comment_id, Request $request)
    {
        $key = $comment_id . '_negative_vote';

        if ($request->cookie($key)) {

            try {

                $this->voteService->decreaseNegativeVotes($comment_id);

                return Response::json([
                    'actionWasPerformed' => 1
                ])->withCookie(Cookie::forget($key));

            } catch (\Exception $e) {

                return Response::json([
                    'message' => $e->getMessage()
                ]);

            }
        }

        return Response::json([
            'actionWasPerformed' => 2
        ]);
    }
}