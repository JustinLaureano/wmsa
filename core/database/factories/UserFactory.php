<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Lottery;
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
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $middleInitial = fake()->randomLetter();

        return [
            'guid' => fake()->uuid(),
            'organization_id' => 1,
            'username' => $this->getUsername($firstName, $middleInitial, $lastName),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'display_name' => $this->getDisplayName($firstName, $lastName),
            'title' => fake()->jobTitle(),
            'description' => fake()->bs(),
            'department' => $this->getDepartment(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    protected function getDepartment() : string
    {
        $departments = [
            'Accounting',
            'Engineering',
            'HR',
            'IT',
            'Materials',
            'Maintenance',
            'Quality',
            'Sales',
            'Training',
        ];

        return fake()->randomElement($departments);
    }

    protected function getDisplayname(string $firstName,string $lastName) : string
    {
        return $lastName .', '. $firstName;
    }

    protected function getUsername(string $firstName, string $middleInitial, string $lastName) : string
    {
        $usernameOld = substr($firstName, 0, 1) . $middleInitial . $lastName;
        $userNameNew = $firstName .'.'. $lastName;

        return Lottery::odds(2, 3)->choose()
            ? $usernameOld
            : $userNameNew;
    }
}
