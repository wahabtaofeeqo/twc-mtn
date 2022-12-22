<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $counter = 0;

    public function definition()
    {
        $this->counter++;
        $code = str_pad(strval($this->counter), 4, "0", STR_PAD_LEFT);

        return [
            'name' => null,
            'code' => 'CHAPERONE/'. $code,
            'category' => 'Chaperone'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
