<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->country;
        
        return [
            'name_ar' => $name,
            'name_en' => $name,
            'code' => '+' . rand(111, 999),
            'flag' => fake()->imageUrl()
        ];
    }
}
