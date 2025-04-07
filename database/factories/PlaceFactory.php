<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,  // Generate a fake company name
            'description' => $this->faker->paragraph,  // Generate a random paragraph for description
            'available' => $this->faker->boolean,  // Random boolean for availability
        ];
    }
}
