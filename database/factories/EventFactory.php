<?php

namespace Database\Factories;

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
        return [
            'user_id' => User::factory(),
            'category_id' => fn () => Category::factory(),
            'title' => $this->faker->words(4, true),
            'description' => $this->faker->paragraph(4),
            'date' => now()->subDays($this->faker->numberBetween(0, 30))->format('Y-m-d'),
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
