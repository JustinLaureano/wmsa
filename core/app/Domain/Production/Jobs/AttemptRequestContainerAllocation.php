<?php

namespace App\Domain\Production\Jobs;

use App\Domain\Materials\Enums\MovementStatusEnum;
use App\Models\MaterialContainer;
use App\Models\MaterialRequest;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AttemptRequestContainerAllocation implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public MaterialRequest $request,
    )
    {
        $this->request->load(['material', 'machine', 'storageLocation']);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger()->info('Attempting to allocate container for request: ' . $this->request->uuid);
        logger()->info($this->request->toArray());

        if ($this->request->storageLocation) {
            $building = $this->request->storageLocation->building;
        }
        else if ($this->request->machine) {
            $building = $this->request->machine->building;
        }
        else {
            throw new Exception('Request does not have a storage location or machine');
        }

        // TODO: finalize query and move to a service class or a stored procedure
        $containers = MaterialContainer::has('location')
            ->where('movement_status_id', MovementStatusEnum::UNRESTRICTED->value)
            ->get();

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