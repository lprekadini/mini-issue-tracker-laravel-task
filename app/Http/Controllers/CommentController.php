<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // GET /issues/{issue}/comments  -> JSON { html, next }
    public function index(Issue $issue, Request $request)
    {
        $comments = $issue->comments()->paginate(5);

        return response()->json([
            'html' => view('issues.partials.comments', compact('comments'))->render(),
            'next' => $comments->nextPageUrl(),
        ]);
    }

    // POST /issues/{issue}/comments -> JSON { html }
    public function store(StoreCommentRequest $request, Issue $issue)
    {
        $comment = $issue->comments()->create($request->validated());

        return response()->json([
            'html' => view('issues.partials.comment', compact('comment'))->render(),
        ], 201);
    }
}
