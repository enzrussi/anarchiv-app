<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Group;
use Illuminate\Support\Str;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Group::class;

    public function definition()
    {
        return [
            'groupname' => $this->faker->word(),
            'groupcode' => $this->faker->word(),
        ];
    }
}
