@extends('layouts.app')
@section('content')
<div class="card">
  <form method="post" action="{{ route('tags.store') }}" class="grid grid-2">
    @csrf
    <div>
      <label>Name</label>
      <input class="input" name="name" value="{{ old('name') }}">
      @error('name')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div>
      <label>Color</label>
      <input class="input" name="color" value="{{ old('color') }}" placeholder="#EAB308">
      @error('color')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div style="grid-column:span 2"><button class="btn">Create</button></div>
  </form>
</div>
@endsection
