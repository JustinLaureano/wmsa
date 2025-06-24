<?php

namespace Database\Seeders;

use App\Domain\Quality\Enums\SortListTypeEnum;
use App\Domain\Quality\Enums\SortListStatusEnum;
use App\Models\Material;
use App\Models\SortList;
use App\Models\SortListCustomer;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;

class SortListSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     Customer,
         *     Part_Number,
         *     `Type`,
         *     `Status`,
         *     Reason,
         *     Percent,
         *     Standard_Time,
         *     Cert,
         *     Line_Side_Sort,
         *     List_Date,
         *     Close_Date
         * FROM wms.tblsortlist
         * ORDER BY id ASC;
         */

        $file = fopen(database_path('data/sort_list/sort_list.csv'), 'r');

        $sortList = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $sortListCustomerUuid = $this->getSortListCustomerUuid($data[0]);
            $materialUuid = $this->getMaterialUuid($data[1]);
            $type = $this->getSortListType($data[2]);
            $status = $this->getSortListStatus($data[3]);

            $sortList[] = array_merge(
                [
                    'sort_list_customer_uuid' => $sortListCustomerUuid,
                    'material_uuid' => $materialUuid,
                    'type' => $type,
                    'status' => $status,
                    'reason' => $data[4] ?? null,
                    'percent' => $data[5] ?? null,
                    'standard_time' => $data[6] ?? null,
                    'cert' => $data[7] ?? null,
                    'line_side_sort' => $data[8] ?? null,
                    'list_date' => $data[9] === 'NULL' ? null : $data[9],
                    'close_date' => $data[10] === 'NULL' ? null : $data[10],
                ],
                $this->getUuid(),
                $this->getTimestamps()
            );
        }

        SortList::insert($sortList);
    }

    protected function getSortListCustomerUuid(string $name) : string
    {
        return SortListCustomer::where('name', $name)
            ->first()
            ->uuid;
    }

    protected function getMaterialUuid(string $partNumber) : string
    {
        return Material::where('part_number', $partNumber)
            ->first()
            ->uuid;
    }

    protected function getSortListType(string $type) : string
    {
        return match ($type) {
            'Internal' => SortListTypeEnum::INTERNAL->value,
            'Customer' => SortListTypeEnum::CUSTOMER->value,
            'Launch' => SortListTypeEnum::LAUNCH->value,
            default => throw new \Exception('Invalid sort list type'),
        };
    }

    protected function getSortListStatus(string $status) : string
    {
        return match ($status) {
            'Open' => SortListStatusEnum::OPEN->value,
            'Pending' => SortListStatusEnum::PENDING->value,
            'In Progress' => SortListStatusEnum::IN_PROGRESS->value,
            'Closed' => SortListStatusEnum::CLOSED->value,
            default => throw new \Exception('Invalid sort list status'),
        };
    }
}
