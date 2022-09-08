<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'cargo' => $this->faker->jobTitle(),
            'status' => $this->faker->randomElement(['ATIVO', 'BLOQUEADO']),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
