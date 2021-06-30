<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    private $types = ['economy','standard', 'business'];
    private $money = [50, 100, 150];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $flights = Flight::all()->pluck('id')->toArray();

        return [
            'flight_id' => $flights[rand(0,24)],
            'type' =>  $this->types[rand(0,2)],
            'cost' => $this->money[rand(0,2)],
        ];
    }
}
