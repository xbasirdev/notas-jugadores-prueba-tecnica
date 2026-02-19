<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $title ?? 'Notas Jugadores' }}</title>
    <style>
        :root{--bg:#f5f7fb;--card:#ffffff;--muted:#6b7280;--accent:#2563eb;--danger:#dc2626}
        html,body{height:100%;margin:0;font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial}
        body{background:var(--bg);color:#0f172a}
        .container{max-width:1100px;margin:32px auto;padding:0 16px}
        header.site{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
        .brand{display:flex;gap:12px;align-items:center}
        .logo{width:40px;height:40px;border-radius:8px;background:linear-gradient(135deg,#60a5fa,#7c3aed);display:flex;align-items:center;justify-content:center;color:white;font-weight:700}
        .nav-actions{display:flex;gap:8px;align-items:center}
        .card{background:var(--card);border-radius:8px;padding:18px;box-shadow:0 6px 18px rgba(15,23,42,0.06)}
        .grid{display:grid;grid-template-columns:1fr 320px;gap:16px}
        .btn{background:var(--accent);color:white;padding:8px 12px;border-radius:6px;border:none;cursor:pointer}
        .btn.ghost{background:transparent;color:var(--accent);border:1px solid rgba(37,99,235,0.12)}
        input,select,textarea{width:100%;padding:8px;border-radius:6px;border:1px solid #e6eef8;background:#fff}
        table{width:100%;border-collapse:collapse}
        th,td{padding:10px;border-bottom:1px solid #eef2ff;text-align:left}
        .muted{color:var(--muted)}
        .center{display:flex;align-items:center;justify-content:center}
        footer{margin-top:28px;color:var(--muted);font-size:13px}
        @media(max-width:800px){.grid{grid-template-columns:1fr}.nav-actions{gap:6px}}
    </style>
    @livewireStyles
</head>
<body>
    <div class="container">
        <header class="site">
            <div class="brand">
                <div class="logo">NJ</div>
                <div>
                    <div style="font-weight:700">Notas Jugadores</div>
                    <div class="muted" style="font-size:13px">Elaborado por: Xavier Basir</div>
                </div>
            </div>
            <div class="nav-actions">
                @auth
                    <div class="muted">{{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn ghost" type="submit">cerrar sesión</button></form>
                @endauth
            </div>
        </header>

        <main>
            {{ $slot ?? $slot ?? '' }}
        </main>

        <footer class="center">
            <div class="muted">© {{ date('Y') }} Notas Jugadores • Xavier Basir</div>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
