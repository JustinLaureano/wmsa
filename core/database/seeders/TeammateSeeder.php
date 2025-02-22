<?php

namespace Database\Seeders;

use App\Models\Teammate;
use App\Repositories\DomainAccountRepository;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class TeammateSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/teammates.csv'), 'r');

        $teammates = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $firstName = $data[2];
            $lastName = $data[3];

            $da = (new DomainAccountRepository)->findForTeammate($firstName, $lastName);

            $teammates[] = array_merge([
                'clock_number' => $data[0],
                'domain_account_guid' => $da->guid ?? null,
                'organization_id' => $data[1],
                'first_name' => $firstName,
                'last_name' => $lastName,
                'hire_date' => $data[4],
            ], $this->getTimestamps());
        }

        Teammate::insert($teammates);
    }
}
