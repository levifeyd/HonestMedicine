<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static function newFactory(): Factory
    {
        return ItemFactory::new();
    }
    public function definition()
    {
        return [
            'name'=>Str::random(10),
            'key' =>Str::random(3),
        ];
    }
}
