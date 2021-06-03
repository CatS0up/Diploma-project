<?php

namespace Database\Factories;

use App\Models\PersonalDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonalDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName('male'),
            'lastname' => $this->faker->lastName('male'),
            'birthday' => $this->faker->date('Y-m-d'),
            'gender' => $this->faker->randomElement(['m', 'k'])
        ];
    }
}
