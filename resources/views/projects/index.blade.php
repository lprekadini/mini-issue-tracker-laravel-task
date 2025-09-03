@extends('layouts.app')
@section('content')
<div class="toolbar">
  <a class="btn" href="{{ route('projects.create') }}">New Project</a>
</div>

<div class="grid grid-2">
@foreach($projects as $project)
  <div class="card">
    <h3 style="margin:0 0 6px 0">{{ $project->name }}</h3>
    <div class="muted">Issues: {{ $project->issues_count }}</div>
    <p>{{ \Illuminate\Support\Str::limit($project->description, 120) }}</p>
    <a class="btn secondary" href="{{ route('projects.show',$project) }}">Open</a>
    <a class="btn secondary" href="{{ route('projects.edit',$project) }}">Edit</a>
  </div>
@endforeach
</div>

{{ $projects->links() }}
@endsection
