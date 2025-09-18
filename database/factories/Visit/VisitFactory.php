<?php

namespace Database\Factories\Visit;

use App\Entities\Visit\VisitEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Entities\Visit\VisitEntity>
 */
class VisitFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = VisitEntity::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}