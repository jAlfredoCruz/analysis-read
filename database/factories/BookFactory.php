<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'isbn' => strval($this->faker->numberBetween(100,999))."-".strval($this->faker->numberBetween(1000000000,9999999999)),
            'type' => null,
            'proposal' => null,
            'my_own_category_id' => null
        ];
    }
}
