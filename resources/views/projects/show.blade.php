@extends('layouts.app')
@section('content')
<div class="card">
  <h2 style="margin:0 0 8px 0">{{ $project->name }}</h2>
  <div class="muted">
    Start: {{ optional($project->start_date)->toDateString() ?? '—' }}
    · Deadline: {{ optional($project->deadline)->toDateString() ?? '—' }}
  </div>
  <p>{{ $project->description }}</p>
  <a class="btn secondary" href="{{ route('issues.create') }}?project_id={{ $project->id }}">Create Issue</a>
</div>

<div class="card">
  <h3>Issues</h3>
  <table class="table">
    <thead><tr><th>Title</th><th>Status</th><th>Priority</th><th>Due</th><th>Tags</th><th></th></tr></thead>
    <tbody>
    @foreach($project->issues as $issue)
      <tr>
        <td><a href="{{ route('issues.show',$issue) }}">{{ $issue->title }}</a></td>
        <td><span class="badge">{{ $issue->status }}</span></td>
        <td><span class="badge">{{ $issue->priority }}</span></td>
        <td>{{ optional($issue->due_date)->toDateString() ?? '—' }}</td>
        <td>@include('issues.partials.tags',['issue'=>$issue])</td>
        <td><a class="btn secondary" href="{{ route('issues.edit',$issue) }}">Edit</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection
