<?php

namespace Database\Factories;

use App\Models\Log;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Log::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            "name" => "DCLP" . $this->faker->numberBetween(1,10),
            "temperature" => $this->faker->randomFloat(2,0,25),
            "timestamp" => $this->faker->dateTimeBetween("-30 Days"),
        ];
    }
}
