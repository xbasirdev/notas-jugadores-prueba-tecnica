@php $title = 'Edit User - Notas Jugadores' @endphp
<x-layouts.app>
    <div style="max-width:720px;margin:16px auto">
        <div class="card">
            <h2 style="margin-top:0">Edit user</h2>

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div style="margin-bottom:8px">
                    <label class="muted">Nombre</label>
                    <input name="name" value="{{ old('name', $user->name) }}" required />
                </div>
                <div style="margin-bottom:8px">
                    <label class="muted">Email</label>
                    <input name="email" type="email" value="{{ old('email', $user->email) }}" required />
                </div>
                <div style="margin-bottom:8px">
                    <label class="muted">Contraseña (dejar en blanco para mantener)</label>
                    <input name="password" type="password" />
                </div>
                <div style="margin-bottom:8px">
                    <label class="muted">Roles</label>
                    <select name="roles[]" multiple>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" @if(in_array($role->name, $user->roles->pluck('name')->toArray())) selected @endif>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-bottom:8px">
                    <label class="muted"><input type="checkbox" name="active" value="1" @if($user->active) checked @endif /> Activo</label>
                </div>
                <div style="display:flex;gap:8px;justify-content:flex-end">
                    <a class="btn ghost" href="{{ route('users.index') }}">Atras</a>
                    <button class="btn" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
