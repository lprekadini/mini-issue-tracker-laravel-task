@extends('layouts.app')
@section('content')
<div class="card">
  <form method="post" action="{{ route('projects.update',$project) }}" class="grid grid-2">
    @csrf @method('PUT')
    <div>
      <label>Name</label>
      <input class="input" name="name" value="{{ old('name',$project->name) }}">
      @error('name')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
      <label>Start date</label>
      <input class="input" type="date" name="start_date" value="{{ old('start_date', optional($project->start_date)->format('Y-m-d')) }}">
      @error('start_date')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
      <label>Deadline</label>
      <input class="input" type="date" name="deadline" value="{{ old('deadline', optional($project->deadline)->format('Y-m-d')) }}">
      @error('deadline')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div style="grid-column:span 2">
      <label>Description</label>
      <textarea class="input" name="description" rows="4">{{ old('description',$project->description) }}</textarea>
      @error('description')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div style="grid-column:span 2"><button class="btn">Update</button></div>
  </form>
</div>

<form method="post" action="{{ route('projects.destroy',$project) }}" onsubmit="return confirm('Delete project?');" style="margin-top:12px">
  @csrf @method('DELETE')
  <button class="btn" style="background:#b91c1c">Delete</button>
</form>
@endsection
