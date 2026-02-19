@php $title = 'Create User - Notas Jugadores' @endphp
<x-layouts.app>
    <div style="max-width:720px;margin:16px auto">
        <div class="card">
            <h2 style="margin-top:0">Crear usuario</h2>

            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div style="margin-bottom:8px">
                    <label class="muted">Nombre</label>
                    <input name="name" required />
                </div>
                <div style="margin-bottom:8px">
                    <label class="muted">Email</label>
                    <input name="email" type="email" required />
                </div>
                <div style="margin-bottom:8px">
                    <label class="muted">Contraseña</label>
                    <input name="password" type="password" required />
                </div>
                <div style="margin-bottom:8px">
                    <label class="muted">Roles</label>
                    <select name="roles[]" multiple>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="display:flex;gap:8px;justify-content:flex-end">
                    <a class="btn ghost" href="{{ route('users.index') }}">Atras</a>
                    <button class="btn" type="submit">Crear usuario</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
