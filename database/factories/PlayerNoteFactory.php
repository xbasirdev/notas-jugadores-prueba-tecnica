<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PlayerNote;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlayerNote>
 */
class PlayerNoteFactory extends Factory
{
    protected $model = PlayerNote::class;

    public function definition(): array
    {
        $player = User::factory()->create();
        $author = User::factory()->create();

        return [
            'player_id' => $player->id,
            'author_id' => $author->id,
            'content' => fake()->sentence(12),
        ];
    }
}
