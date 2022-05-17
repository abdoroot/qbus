<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text,
            'description' => $this->faker->text,
            'image' => $this->faker->word,
            'date_from' => $this->faker->word,
            'date_to' => $this->faker->word,
            'time_from' => $this->faker->word,
            'time_to' => $this->faker->word,
            'lat' => $this->faker->word,
            'lng' => $this->faker->word,
            'zoom' => $this->faker->randomDigitNotNull,
            'provider_id' => $this->faker->word,
            'bus_id' => $this->faker->word,
            'fees' => $this->faker->randomDigitNotNull,
            'max' => $this->faker->randomDigitNotNull,
            'provider_notes' => $this->faker->text,
            'provider_archive' => $this->faker->word,
            'meal' => $this->faker->word,
            'hotel' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
