@extends('layouts.app')
@section('content')
<div class="card">
  <form method="post" action="{{ route('tags.store') }}" class="toolbar">
    @csrf
    <input class="input" name="name" placeholder="New tag name">
    <input class="input" name="color" placeholder="#HEX (optional)">
    <button class="btn">Create</button>
  </form>

  @error('name')<div class="error">{{ $message }}</div>@enderror
  @error('color')<div class="error">{{ $message }}</div>@enderror

  <div>
    @foreach($tags as $tag)
      <span class="tag" style="background:{{ $tag->color ?? '#fff' }}33">
        <span style="width:10px;height:10px;border-radius:999px;display:inline-block;background:{{ $tag->color ?? '#9CA3AF' }}"></span>
        {{ $tag->name }}
      </span>
    @endforeach
  </div>

  {{ $tags->links() }}
</div>
@endsection
