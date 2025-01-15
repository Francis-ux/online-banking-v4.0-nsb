<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->dateTime(),
            'email_code' => $this->faker->md5(),
            'registration_token' => 'RB-31',
            'dob' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'marital_status' => $this->faker->randomElement(['single', 'married', 'divorced', 'widowed']),
            'dial_code' => $this->faker->numerify('+###'),
            'phone' => $this->faker->phoneNumber(),
            'professional_status' => $this->faker->jobTitle(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'nationality' => $this->faker->country(),
            'currency' => 'United State Dollar-USD-$',
            'account_type' => $this->faker->randomElement(['savings', 'checking']),
            'password' => Hash::make('password'),
            'should_login_require_code' => $this->faker->boolean(),
            'login_code' => $this->faker->md5(),
            'should_transfer_fail' => $this->faker->boolean(),
            'transfer_pin' => $this->faker->numerify('####'),
            'account_number' => $this->faker->bankAccountNumber(),
            'is_account_verified' => $this->faker->boolean(),
            'account_state' => 1,
            'account_state_reason' => $this->faker->text(),
            'balance' => $this->faker->randomFloat(2, 0, 10000),
            'ledger_balance' => $this->faker->randomFloat(2, 0, 10000),
            'image' => null,
            'id_front' => $this->faker->imageUrl(),
            'id_back' => $this->faker->imageUrl(),
            'last_login_time' => $this->faker->dateTime(),
            'last_login_device' => $this->faker->dateTime(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
