<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid'                  => $this->faker->uuid,
            'name'                  => $this->faker->userName,
            'email'                 => $this->faker->unique()->safeEmail,
            'password'              => Hash::make('password'),
            'status'                => true,
            'registration_token'    => getRegistrationToken(config('app.name')),
            'dial_code'             => $this->faker->numerify('+###'),
            'phone'                 => $this->faker->phoneNumber,
            'address'               => $this->faker->address,
            'live_chat'             => $this->faker->text,
            'live_chat_id'          => $this->faker->uuid,
            'smtp_user'             => $this->faker->userName,
            'smtp_password'         => $this->faker->password,
            'smtp_host'             => $this->faker->domainName,
            'smtp_port'             => $this->faker->domainName,
            'smtp_encryption'       => $this->faker->domainName,
            'btc_address'           => $this->faker->uuid,
            'btc_qr_code'           => $this->faker->uuid,
            'created_at'            => now(),
            'updated_at'            => now(),
        ];
    }
}
