<?php

namespace Database\Factories;

use App\Models\Implementation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ImplementationFactory extends Factory
{
    protected $model = Implementation::class;

    public function definition(): array
    {
        $urls = [];
        for ($i = 1; $i <= 3; $i++) {
            $urls[] = $this->faker->url();
        }

        return [
            'urls' => $urls,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
