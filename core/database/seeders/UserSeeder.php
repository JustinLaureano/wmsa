<?php

namespace Database\Seeders;

use App\Domain\Auth\DataTransferObjects\UserData;
use App\Models\Teammate;
use App\Models\User;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;
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
        $teammates = Teammate::with('domainAccount')->get();
        $data = [];

        foreach ($teammates as $teammate) {
            $userData = new UserData(
                uuid: Str::uuid(),
                organization_id: 1,
                domain_account_guid: $teammate->domainAccount?->guid,
                teammate_clock_number: $teammate->clock_number,
            );

            $data[] = array_merge(
                $userData->toArray(),
                $this->getTimestamps()
            );
        }

        User::insert($data);
    }
}
