<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entity>
 */
class EntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['M', 'F'];
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'purok' => 'PUROK 1',
            'barangay' => '071244015',
            'municipality' => '071244',
            'province' => '0712',
            'sex' => array_rand($gender),
            'email' => $this->faker->email(),
            'created_by' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'status' => 1
        ];
    }
}
