@extends('layouts.app')
@section('content')
<div class="card">
  <h2 style="margin:0">{{ $issue->title }}</h2>
  <div class="muted">
    Project: <a href="{{ route('projects.show',$issue->project) }}">{{ $issue->project->name }}</a>
    · Status: {{ $issue->status }} · Priority: {{ $issue->priority }}
    · Due: {{ optional($issue->due_date)->toDateString() ?? '—' }}
  </div>
  <p>{{ $issue->description }}</p>

  <h3>Tags</h3>
  <div id="tags-wrapper">@include('issues.partials.tags',['issue'=>$issue])</div>

  <details style="margin-top:8px">
    <summary>Attach tags</summary>
    <form id="attach-tags-form">
      <select multiple size="5" name="tag_ids[]" class="input" style="max-width:360px">
        @foreach($allTags as $t)
          <option value="{{ $t->id }}">{{ $t->name }}</option>
        @endforeach
      </select>
      <button class="btn" type="submit">Attach Selected</button>
    </form>
  </details>
</div>

<div class="card">
  <h3>Comments</h3>
  <form id="comment-form" class="grid grid-2" onsubmit="return false;">
    <div>
      <label>Your name</label>
      <input class="input" name="author_name">
      <div class="error" data-error="author_name"></div>
    </div>
    <div style="grid-column:span 2">
      <label>Comment</label>
      <textarea class="input" name="body" rows="3"></textarea>
      <div class="error" data-error="body"></div>
    </div>
    <div style="grid-column:span 2"><button class="btn" id="add-comment">Add Comment</button></div>
  </form>

  <div id="comments-list"></div>
  <button class="btn secondary" id="load-more" style="display:none;margin-top:8px">Load more</button>
</div>

@push('scripts')
<script>
  // Attach tags
  const attachForm = document.getElementById('attach-tags-form');
  if (attachForm) attachForm.addEventListener('submit', async (e)=>{
    e.preventDefault();
    const data = new FormData(attachForm);
    const tag_ids = [...data.getAll('tag_ids[]')];
    const res = await post('{{ route('issues.tags.attach',$issue) }}', { tag_ids });
    const json = await res.json();
    document.getElementById('tags-wrapper').innerHTML = json.html;
  });

  async function detachTag(tagId){
    const url = '{{ route('issues.tags.detach', [$issue->id, 0]) }}'.replace('/0', `/${tagId}`);
    const res = await del(url);
    const json = await res.json();
    document.getElementById('tags-wrapper').innerHTML = json.html;
  }

  // Comments pagination
  let nextUrl = '{{ route('issues.comments.index',$issue) }}';
  const list = document.getElementById('comments-list');
  const btnMore = document.getElementById('load-more');

  async function loadPage(){
    if (!nextUrl) return;
    const res = await fetch(nextUrl, {headers:{'Accept':'application/json'}});
    const data = await res.json();
    list.insertAdjacentHTML('beforeend', data.html);
    nextUrl = data.next;
    btnMore.style.display = nextUrl ? 'inline-block' : 'none';
  }
  btnMore.addEventListener('click', loadPage);
  loadPage(); // initial

  // Add comment
  const form = document.getElementById('comment-form');
  const btnAdd = document.getElementById('add-comment');
  btnAdd.addEventListener('click', async ()=>{
    document.querySelectorAll('[data-error]').forEach(el=>el.textContent='');
    const payload = Object.fromEntries(new FormData(form).entries());
    const res = await post('{{ route('issues.comments.store',$issue) }}', payload);
    if (res.status === 422){
      const data = await res.json();
      for (const [field,msgs] of Object.entries(data.errors)){
        const el = document.querySelector(`[data-error="${field}"]`);
        if (el) el.textContent = msgs[0];
      }
      return;
    }
    const data = await res.json();
    list.insertAdjacentHTML('afterbegin', data.html); // prepend
    form.reset();
  });
</script>
@endpush
@endsection
