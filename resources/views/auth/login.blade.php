@php $title = 'Login - Notas Jugadores' @endphp
<x-layouts.app>
    <div style="max-width:420px;margin:48px auto">
        <div class="card">
            <h2 style="margin-top:0">Inicia sesión.</h2>
            <p class="muted">Inserte sus credenciales</p>

            @if($errors->any())
                <div style="color:#dc2626;margin-top:8px">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="/login" style="margin-top:12px">
                @csrf
                <div style="margin-bottom:8px">
                    <label class="muted">Email</label>
                    <input type="email" name="email" required />
                </div>
                <div style="margin-bottom:8px">
                    <label class="muted">Contraseña</label>
                    <input type="password" name="password" required />
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:12px">
                    <label class="muted"><input type="checkbox" name="remember" /> Recuerda mi sesión</label>
                    <button class="btn" type="submit">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
