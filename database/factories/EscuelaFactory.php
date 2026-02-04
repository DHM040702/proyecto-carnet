<?php

namespace Database\Factories;

use App\Models\Facultad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Escuela>
 */
class EscuelaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'escuela' => $this->faker->word(),
            'facultad_id' => Facultad::factory(),
            'usercreacion' => 1,
        ];
    }
}
