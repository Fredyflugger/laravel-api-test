<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notebook>
 */
class NotebookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // Генерируем поля схемы с помощью фейкера для тестов
            'name' => $this->faker->name(),
            'phone' => $this->faker->randomNumber(7, true),
            'email' => $this->faker->email(),
            'birth_date' => $this->faker->date('Y_m_d'),
            'photo' => $this->faker->url(),
            'company' => $this->faker->words(3, true),
        ];
    }
}
