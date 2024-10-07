<?php

namespace Database\Seeders;

use App\Domain\Auth\DataTransferObjects\UserData;
use App\Models\User;
use App\Support\CsvReader;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setUsers();
    }

    /**
     * Seed the materials.
     */
    protected function setUsers() : void
    {
        $file = database_path('data/users.csv');
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                $userData = new UserData(
                    guid: Str::uuid(),
                    organization_id: 1,
                    username: $row['username'],
                    first_name: $row['first_name'],
                    last_name: $row['last_name'],
                    display_name: $row['display_name'],
                    title: $row['title'],
                    description: $row['description'],
                    department: $row['department'],
                    email: $row['email']
                );

                $data[$key] = array_merge(
                    $userData->toArray(),
                    [ 'password' => Hash::make('password'), ],
                    $this->getTimestamps()
                );
            }

            User::insert($data);
        }
    }
}
