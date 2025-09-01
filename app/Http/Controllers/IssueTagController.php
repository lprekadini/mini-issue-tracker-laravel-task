<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Tag;
use Illuminate\Http\Request;

class IssueTagController extends Controller
{
    public function store(Request $request, Issue $issue)
    {
        $validated = $request->validate([
            'tag_ids'   => ['required', 'array'],
            'tag_ids.*' => ['exists:tags,id'],
        ]);

        $issue->tags()->syncWithoutDetaching($validated['tag_ids']);
        $issue->load('tags');

        return response()->json([
            'html' => view('issues.partials.tags', ['issue' => $issue])->render(),
        ]);
    }

    public function destroy(Issue $issue, Tag $tag)
    {
        $issue->tags()->detach($tag->id);
        $issue->load('tags');

        return response()->json([
            'html' => view('issues.partials.tags', ['issue' => $issue])->render(),
        ]);
    }
}
