<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uid' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->numberBetween(1000000, 99999999),
            'pwd' => $this->faker->password(),
            'description' => $this->faker->text(255)
        ];
    }
}
