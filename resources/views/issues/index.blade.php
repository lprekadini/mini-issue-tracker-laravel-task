@extends('layouts.app')
@section('content')
<div class="card">
  <form class="toolbar" method="get" action="{{ route('issues.index') }}">
    <select name="status">
      <option value="">Status</option>
      @foreach(\App\Models\Issue::STATUSES as $s)
        <option value="{{ $s }}" @selected(request('status')===$s)>{{ $s }}</option>
      @endforeach
    </select>
    <select name="priority">
      <option value="">Priority</option>
      @foreach(\App\Models\Issue::PRIORITIES as $p)
        <option value="{{ $p }}" @selected(request('priority')===$p)>{{ $p }}</option>
      @endforeach
    </select>
    <select name="tag">
      <option value="">Tag</option>
      @foreach($tags as $tag)
        <option value="{{ $tag->id }}" @selected(request('tag')==$tag->id)>{{ $tag->name }}</option>
      @endforeach
    </select>
    <button class="btn">Filter</button>
    <a class="btn secondary" href="{{ route('issues.index') }}">Reset</a>
    <a class="btn right" href="{{ route('issues.create') }}">New Issue</a>
  </form>

  <table class="table">
    <thead><tr><th>Title</th><th>Project</th><th>Status</th><th>Priority</th><th>Due</th><th>Tags</th><th>Comments</th><th></th></tr></thead>
    <tbody>
      @foreach($issues as $issue)
      <tr>
        <td><a href="{{ route('issues.show',$issue) }}">{{ $issue->title }}</a></td>
        <td>{{ $issue->project->name }}</td>
        <td>{{ $issue->status }}</td>
        <td>{{ $issue->priority }}</td>
        <td>{{ optional($issue->due_date)->toDateString() ?? '—' }}</td>
        <td>@include('issues.partials.tags',['issue'=>$issue])</td>
        <td>{{ $issue->comments_count }}</td>
        <td><a class="btn secondary" href="{{ route('issues.edit',$issue) }}">Edit</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $issues->links() }}
</div>
@endsection
