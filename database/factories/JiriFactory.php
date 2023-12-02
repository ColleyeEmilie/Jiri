<?php

namespace Database\Factories;

use App\Models\Jiri;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jiri>
 */
class JiriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Jiri '.$this->faker->word,
            'starting_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'), ];
    }
}
