<div>
    <h2 style="margin-top:0">Notas de jugadores</h2>

    <div style="overflow:auto">
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Jugador</th>
                <th>Autor</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notes as $note)
                <tr>
                    <td class="muted">{{ $note->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ optional($note->player)->name ?? '—' }}</td>
                    <td>{{ optional($note->author)->name ?? '—' }}</td>
                    <td style="max-width:420px;white-space:pre-wrap;">{{ $note->content }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="muted">No se encontraron notas.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>

    @can('create', \App\Models\PlayerNote::class)
        <div style="margin-top:16px">
            <h3 style="margin-bottom:8px">Crear nota</h3>
            <form wire:submit.prevent="addNote" class="card">
                <div style="margin-bottom:8px">
                    <label class="muted">Jugador</label>
                    <select wire:model="player_id" id="player">
                        <option value="">Seleccionar Jugador</option>
                        @foreach($players as $p)
                            <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->email }})</option>
                        @endforeach
                    </select>
                    @error('player_id') <div style="color:#c00">{{ $message }}</div> @enderror
                </div>
                <div style="margin-bottom:8px">
                    <label class="muted">Nota</label>
                    <textarea wire:model.defer="content" rows="4" placeholder="Escribir nota..."></textarea>
                    @error('content') <div style="color:#c00">{{ $message }}</div> @enderror
                </div>
                <div style="display:flex;gap:8px;justify-content:flex-end">
                    <button type="submit" class="btn">Agregar nota</button>
                </div>
            </form>
        </div>
    @endcan
</div>
