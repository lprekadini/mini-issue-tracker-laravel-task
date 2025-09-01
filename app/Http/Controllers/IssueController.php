<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index(Request $request)
    {
        $query = Issue::query()->with(['project', 'tags'])->withCount('comments');

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }
        if ($priority = $request->input('priority')) {
            $query->where('priority', $priority);
        }
        if ($tagId = $request->input('tag')) {
            $query->whereHas('tags', fn ($q) => $q->where('tags.id', $tagId));
        }

        $issues = $query->latest()->paginate(10)->withQueryString();
        $tags = Tag::orderBy('name')->get();

        return view('issues.index', compact('issues', 'tags'));
    }

    public function create()
    {
        $projects = Project::orderBy('name')->get();
        return view('issues.create', compact('projects'));
    }

    public function store(StoreIssueRequest $request)
    {
        $issue = Issue::create($request->validated());
        return redirect()->route('issues.show', $issue)->with('success', 'Issue created.');
    }

    public function show(Issue $issue)
    {
        $issue->load(['project', 'tags'])->loadCount('comments');
        $allTags = Tag::orderBy('name')->get();

        return view('issues.show', compact('issue', 'allTags'));
    }

    public function edit(Issue $issue)
    {
        $projects = Project::orderBy('name')->get();
        return view('issues.edit', compact('issue', 'projects'));
    }

    public function update(UpdateIssueRequest $request, Issue $issue)
    {
        $issue->update($request->validated());
        return redirect()->route('issues.show', $issue)->with('success', 'Issue updated.');
    }

    public function destroy(Issue $issue)
    {
        $issue->delete();
        return redirect()->route('issues.index')->with('success', 'Issue deleted.');
    }
}
