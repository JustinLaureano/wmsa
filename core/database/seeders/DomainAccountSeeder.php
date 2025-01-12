<?php

namespace Database\Seeders;

use App\Domain\Auth\DataTransferObjects\DomainAccountData;
use App\Models\DomainAccount;
use App\Support\CsvReader;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str;

class DomainAccountSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setDomainAccounts();
    }

    /**
     * Seed the materials.
     */
    protected function setDomainAccounts() : void
    {
        $file = database_path('data/domain_accounts.csv');
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                $domainAccountData = new DomainAccountData(
                    guid: Str::uuid(),
                    username: $row['username'],
                    first_name: $row['givenname'],
                    last_name: $row['sn'],
                    display_name: $row['displayname'],
                    title: $row['title'],
                    description: $row['description'],
                    department: $row['department'],
                    email: $row['mail']
                );

                $data[$key] = array_merge(
                    $domainAccountData->toArray(),
                    [ 'password' => Hash::make('password'), ],
                    $this->getTimestamps()
                );
            }

            DomainAccount::insert($data);
        }
    }
}
