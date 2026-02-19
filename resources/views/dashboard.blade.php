@php $title = 'Dashboard - Notas Jugadores' @endphp
<x-layouts.app>
    <div class="grid">
        <div>
            <div class="card">
                <h2 style="margin:0 0 8px 0">Dashboard</h2>
                <div class="muted" style="margin-bottom:12px">Bienvenido, {{ auth()->user()->name }} — aqui estan las notas de los jugadores.</div>

                <livewire:dashboard-notes />
            </div>
        </div>

        <aside>
            @role('admin')
            <div class="card">
                <h3 style="margin-top:0">Menú </h3>
                <div style="display:flex;flex-direction:column;gap:8px;margin-top:8px">
                    <a class="btn ghost" href="{{ route('users.index') }}">Gestionar usuarios</a>
                </div>
            </div>
            @endrole
        </aside>
    </div>
</x-layouts.app>

