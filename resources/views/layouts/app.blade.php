<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Mini Issue Tracker</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/2.0.0/modern-normalize.min.css">
  <style>
    body{font-family:ui-sans-serif,system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#fafafa}
    .container{max-width:1100px;margin:auto;padding:24px}
    .card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;margin-bottom:16px;box-shadow:0 1px 2px rgba(0,0,0,.04)}
    .btn{display:inline-block;padding:8px 12px;border-radius:8px;border:1px solid #d1d5db;background:#111827;color:#fff;text-decoration:none;cursor:pointer}
    .btn.secondary{background:#fff;color:#111827}
    .badge{display:inline-block;padding:2px 8px;border-radius:999px;font-size:12px;border:1px solid #e5e7eb}
    .grid{display:grid;gap:12px}
    .grid-2{grid-template-columns:1fr 1fr}
    .muted{color:#6b7280;font-size:14px}
    .error{color:#b91c1c;font-size:14px}
    .input, select, textarea{width:100%;padding:8px;border-radius:8px;border:1px solid #d1d5db}
    .table{width:100%;border-collapse:separate;border-spacing:0}
    .table th,.table td{padding:10px;border-bottom:1px solid #e5e7eb;text-align:left}
    .toolbar{display:flex;gap:8px;align-items:center;flex-wrap:wrap;margin-bottom:12px}
    .right{margin-left:auto}
    .tag{padding:2px 8px;border-radius:999px;border:1px solid #e5e7eb;margin-right:6px;display:inline-flex;align-items:center;gap:6px}
    .tag button{border:none;background:transparent;cursor:pointer}
    .w-5{width: 2rem!important;}
    .h-5{height: 2rem!important;}
  </style>
</head>
<body>
  <div class="container">
    <header class="toolbar">
      <a class="btn secondary" href="{{ route('projects.index') }}">Projects</a>
      <a class="btn secondary" href="{{ route('issues.index') }}">Issues</a>
      <a class="btn secondary" href="{{ route('tags.index') }}">Tags</a>
      <div class="right muted">Mini Issue Tracker</div>
    </header>

    @if(session('success'))
      <div class="card" style="border-left:4px solid #10b981">{{ session('success') }}</div>
    @endif

    @yield('content')
  </div>

  <script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    function post(url, data){
      return fetch(url,{method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'}, body:JSON.stringify(data)});
    }
    function del(url){
      return fetch(url,{method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
    }
  </script>
  @stack('scripts')
</body>
</html>

