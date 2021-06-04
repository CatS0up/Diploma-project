<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'town' => $this->faker->city(),
            'zipcode' => $this->faker->postcode(),
            'street' => $this->faker->streetName(),
            'local_number' => $this->faker->buildingNumber()
        ];
    }
}
