<?php

namespace Database\Factories;

use Faker\Provider\id_ID\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement([Person::GENDER_MALE, Person::GENDER_FEMALE]);
        $religion = $this->faker->randomElement(['ISLAM', 'PROTESTAN', 'KATHOLIK', 'BUDDHA', 'HINDU', 'KONGHUCU']);
        return [
            'nip' => $this->faker->randomNumber(5, true),
            'nik' => $this->faker->nik($gender),
            'name' => $this->faker->name($gender),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'front_title' => $this->faker->title($gender),
            'rear_title' => $this->faker->title($gender),
            'gender' => Str::upper($gender),
            'religion' => $religion,
            'birth_date' => $this->faker->date('Y-m-d', '2000-12-31'),
            'birth_place' => $this->faker->city(),
            'address' => $this->faker->address(),
            'zip_code' => $this->faker->postcode()
        ];
    }
}
