<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variation>
 */
class VariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randType = ['radio', 'text', 'textarea', 'checkbox', 'file'];
        return [
            'name' => $this->faker->name(),
            'attribute_type' => $this->faker->randomElement($randType)
        ];
    }
}
