@extends('layouts.app')
@section('content')
<div class="card">
  <form method="post" action="{{ route('issues.store') }}" class="grid grid-2">
    @csrf
    <div>
      <label>Project</label>
      <select name="project_id" class="input">
        @foreach($projects as $p)
          <option value="{{ $p->id }}" @selected(request('project_id')==$p->id)>{{ $p->name }}</option>
        @endforeach
      </select>
      @error('project_id')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
      <label>Title</label>
      <input class="input" name="title" value="{{ old('title') }}">
      @error('title')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div style="grid-column:span 2">
      <label>Description</label>
      <textarea class="input" name="description" rows="4">{{ old('description') }}</textarea>
      @error('description')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
      <label>Status</label>
      <select name="status" class="input">
        @foreach(\App\Models\Issue::STATUSES as $s)
          <option value="{{ $s }}">{{ $s }}</option>
        @endforeach
      </select>
      @error('status')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
      <label>Priority</label>
      <select name="priority" class="input">
        @foreach(\App\Models\Issue::PRIORITIES as $p)
          <option value="{{ $p }}">{{ $p }}</option>
        @endforeach
      </select>
      @error('priority')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
      <label>Due date</label>
      <input type="date" name="due_date" class="input" value="{{ old('due_date') }}">
      @error('due_date')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div style="grid-column:span 2"><button class="btn">Create</button></div>
  </form>
</div>
@endsection
