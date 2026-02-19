@php $title = 'Users - Notas Jugadores' @endphp
<x-layouts.app>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
        <div>
            <h1 style="margin:0">Users</h1>
            <div class="muted" style="font-size:13px">Manage application users and roles</div>
        </div>
        <div style="display:flex;gap:8px;align-items:center">
            <a class="btn ghost" href="{{ route('dashboard') }}">Regresar</a>
        </div>
    </div>

    <div style="margin-bottom:12px">
        <a class="btn" href="{{ route('users.create') }}">Crear usuario</a>
    </div>

    <div class="card">
    <table>
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Roles</th><th>Active</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                    <td>{{ $user->active ? 'Si' : 'No' }}</td>
                    <td>
                        <a class="btn ghost" href="{{ route('users.edit', $user->id) }}">Editar</a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">@csrf @method('DELETE')<button class="btn" type="submit">{{ $user->active ? 'Desactivar' : 'Activar' }}</button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div style="margin-top:12px">
        {{ $users->links() }}
    </div>
</x-layouts.app>
