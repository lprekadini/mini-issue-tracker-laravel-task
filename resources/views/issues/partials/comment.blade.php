<div class="card" style="margin:8px 0">
  <div class="muted">{{ $comment->author_name }} • {{ $comment->created_at->diffForHumans() }}</div>
  <div>{!! nl2br(e($comment->body)) !!}</div>
</div>
