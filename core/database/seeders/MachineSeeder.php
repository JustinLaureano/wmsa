<?php

namespace Database\Seeders;

use App\Domain\Production\DataTransferObjects\MachineData;
use App\Models\Machine;
use App\Models\MachineType;
use App\Support\CsvReader;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    use Timestamps, Uuid;

    protected array $types;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->getMachineTypeOptions();

        $this->setMachines();
    }

    /**
     * Get the machine types as options array.
     */
    protected function getMachineTypeOptions() : void
    {
        $this->types = MachineType::get()
            ->reduce(function (array $carry, MachineType $type) {

                $carry[$type->name] = $type->id;

                return $carry;
            }, []);
    }

    /**
     * Seed the machines.
     */
    protected function setMachines() : void
    {
        $file = database_path('data/machines.csv');
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                $machineData = new MachineData(
                    name: $row['area'],
                    barcode: $row['id'],
                    building_id: $row['building'],
                    machine_type_id: $this->types[$row['machine_type']],
                    restrict_request_allocations: 0,
                    disabled: $row['disabled']
                );

                $data[$key] = array_merge(
                    $machineData->toArray(),
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }

            Machine::insert($data);
        }
    }
}
