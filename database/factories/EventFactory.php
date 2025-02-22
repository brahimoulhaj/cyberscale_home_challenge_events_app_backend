<?php

namespace Database\Factories;

use App\Enums\ROLE;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $user->assignRole(ROLE::USER);

        return [
            'user_id' => $user->id,
            'category_id' => fn () => Category::factory(),
            'title' => $this->faker->words(4, true),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraph(4),
            'date' => now()->addDays($this->faker->numberBetween(0, 30))->format('Y-m-d'),
            'time' => $this->faker->randomElement([
                '10:00:00',
                '12:00:00',
                '14:00:00',
                '16:00:00',
            ]),
            'max_participants' => $this->faker->numberBetween(1, 100),
            'location' => $this->faker->address(),
            'map_location' => $this->faker->latitude().','.$this->faker->longitude(),
        ];
    }
}
