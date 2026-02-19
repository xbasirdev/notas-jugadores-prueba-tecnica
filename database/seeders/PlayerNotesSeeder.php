<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlayerNote;
use App\Models\User;

class PlayerNotesSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have at least some users to attach notes to
        $players = User::role('player')->get();
        $authors = User::role('author')->get();

        if ($players->isEmpty() || $authors->isEmpty()) {
            // Fallback: use any users if roles not present
            $players = User::all()->take(5);
            $authors = User::all()->take(3);
        }

        $shortNotes = [
            'Buen rendimiento hoy.',
            'Necesita mejorar la concentración.',
            'Excelente actitud en el entrenamiento.',
            'Mostraría mejora con trabajo físico.',
            'Buen pase al compañero.',
            'Falta de posicionamiento defensivo.',
            'Buen remate de cabeza.',
            'Se anticipa bien a las jugadas.',
            'Debe controlar mejor el balón.',
            'Buena comunicación con el equipo.',
            'Necesita practicar tiros libres.',
            'Responde bien a las indicaciones.',
            'Le cuesta mantener ritmo todo el partido.',
            'Destaca en labores tácticas.',
            'Gran recuperación tras lesión.',
        ];

        $i = 0;

        foreach ($shortNotes as $noteText) {
            $player = $players[$i % $players->count()];
            $author = $authors[$i % $authors->count()];

            PlayerNote::firstOrCreate([
                'player_id' => $player->id,
                'author_id' => $author->id,
                'content' => $noteText,
            ]);

            $i++;
        }
    }
}
