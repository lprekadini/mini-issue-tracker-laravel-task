@foreach($issue->tags as $tag)
  <span class="tag" title="{{ $tag->name }}" style="background:{{ $tag->color ?? '#fff' }}33">
    <span style="width:10px;height:10px;border-radius:999px;display:inline-block;background:{{ $tag->color ?? '#9CA3AF' }}"></span>
    {{ $tag->name }}
    <button onclick="detachTag({{ $tag->id }})" aria-label="Remove tag">✕</button>
  </span>
@endforeach
@if($issue->tags->isEmpty())
  <span class="muted">No tags</span>
@endif
