<?php

namespace App\Domain\Production\Jobs;

use App\Domain\Materials\Enums\MovementStatusEnum;
use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Models\MaterialContainer;
use App\Models\MaterialRequestItem;
use App\Repositories\RequestContainerAllocationRepository;
use App\Domain\Production\DataTransferObjects\RequestContainerAllocationData;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class AttemptRequestContainerAllocation implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public MaterialRequestItem $item,
    )
    {
        $this->item->load(['material', 'machine', 'storageLocation']);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger()->info('Attempting to allocate container for request item: ' . $this->item->uuid);
        logger()->info($this->item->toArray());

        if ($this->item->storageLocation) {
            $building = $this->item->storageLocation->building;
        }
        else if ($this->item->machine) {
            $building = $this->item->machine->building;
        }
        else {
            throw new Exception('Request item does not have a storage location or machine');
        }

        $containers = MaterialContainer::has('location')
            ->where([
                ['material_uuid', $this->item->material_uuid],
                ['movement_status_code', MovementStatusEnum::UNRESTRICTED->value],
            ])
            ->orderByExpiration()
            ->get();

        $quantityNeeded = $this->item->quantity_requested - $this->item->quantity_delivered;
        $cycles = 0;

        while ($quantityNeeded > 0 && $containers->count() > 0 && $cycles < 25) {
            $cycles++;

            if ($this->item->unit_of_measure === UnitOfMeasureEnum::CONT->value) {
                $container = $containers->shift();

                try {
                    DB::transaction(function () use ($container) {
                        (new RequestContainerAllocationRepository)
                            ->store(new RequestContainerAllocationData(
                                material_request_item_uuid: $this->item->uuid,
                                material_container_uuid: $container->uuid,
                            ));
                    });

                    $quantityNeeded--;

                }
                catch (Exception $e) {
                    $containers->prepend($container);
                    $cycles = 25;
                    continue;
                }
            }
        }

        logger()->info('Containers: ' . $containers->count());
        logger()->info($containers->toArray());
        logger()->info('************************************************');



        /**
         * TODO:
         *  find the most appropriate container for the request based on FIFO rules
         *      determine the request location record
         *      determine the building for the request
         *      determine if request needs a certain tote type   (later)   
         * 
         *      create list of areas that a skid should never be pulled from
         *          coater,s irm, mrb, etc

         *      omit any locked skids
         *      prioritize full skids over partial skids if for a shipping delivery
         *      if the part requires a hold time, order skid options by those that hold time has passed
         *      return the list of skids with the oldest one first
         */
    }
}