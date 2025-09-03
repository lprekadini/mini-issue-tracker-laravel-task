@extends('layouts.app')
@section('content')
<div class="card">
  <form method="post" action="{{ route('projects.store') }}" class="grid grid-2">
    @csrf
    <div>
      <label>Name</label>
      <input class="input" name="name" value="{{ old('name') }}">
      @error('name')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
      <label>Start date</label>
      <input class="input" type="date" name="start_date" value="{{ old('start_date') }}">
      @error('start_date')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
      <label>Deadline</label>
      <input class="input" type="date" name="deadline" value="{{ old('deadline') }}">
      @error('deadline')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div style="grid-column:span 2">
      <label>Description</label>
      <textarea class="input" name="description" rows="4">{{ old('description') }}</textarea>
      @error('description')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div style="grid-column:span 2"><button class="btn">Save</button></div>
  </form>
</div>
@endsection
