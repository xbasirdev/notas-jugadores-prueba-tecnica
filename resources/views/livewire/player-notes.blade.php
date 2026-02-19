@php $notes = $notes ?? collect(); @endphp

<div>
    <div class="notes-list">
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px">Date</th>
                    <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px">Author</th>
                    <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px">Note</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notes as $note)
                    <tr>
                        <td style="padding:8px">{{ $note->created_at->format('Y-m-d H:i') }}</td>
                        <td style="padding:8px">{{ $note->author->name ?? '—' }}</td>
                        <td style="padding:8px">{{ $note->content }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding:8px">No notes yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @can('create', \App\Models\PlayerNote::class)
    <form wire:submit.prevent="addNote" style="margin-top:16px">
        <div>
            <textarea wire:model.defer="content" maxlength="1000" rows="4" style="width:100%" placeholder="Write an internal note..."></textarea>
            @error('content') <div style="color:#c00">{{ $message }}</div> @enderror
        </div>
        <div style="margin-top:8px">
            <button type="submit">Add Note</button>
        </div>
    </form>
    @endcan
</div>
