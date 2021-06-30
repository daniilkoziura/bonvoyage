<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;

    private $countries = [
        'Kharkiv', 'Donetsk', 'Dnepr', 'Lvov', 'Kyiv', 'Svetlovodsk', 'TestC'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'flight_name' => $this->faker->name(),
            'departure' => $this->countries[rand(0,6)],
            'departure_time' => now(),
            'destination' => $this->countries[array_rand($this->countries)],
            'arrival_time' => now()->addHours(rand(1,3)),
            'airline' => 'CozyuraF',
        ];
    }
}
