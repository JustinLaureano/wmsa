<?php

namespace App\Domain\Materials\Jobs;

use App\Domain\Materials\DataTransferObjects\ContainerEventData;
use App\Domain\Materials\DataTransferObjects\ContainerLocationData;
use App\Domain\Materials\DataTransferObjects\ContainerMovementData;
use App\Domain\Materials\Events\ContainerMovementFinished;
use App\Models\ContainerLocation;
use App\Repositories\ContainerEventRepository;
use App\Repositories\ContainerLocationRepository;
use App\Repositories\MaterialContainerRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class PerformContainerMovement implements ShouldQueue
{
    use Queueable;

    public ContainerLocation $newContainerLocation;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public ContainerMovementData $data,
    )
    {
        //
        // TODO:
        //    add starting location to data 
        //        it is important to know if it can be moved or if something needs to be done post move to the location
        //        also need info for undo/redo stack and event logging
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $this->determinePreMoveLocation();
            $this->storeContainerInLocation();
            $this->createContainerEvent();
        });

        ContainerMovementFinished::dispatch();
    }

    protected function determinePremoveLocation() : void
    {
        (new MaterialContainerRepository)
            ->findLocation(material_container_uuid: $this->data->container->uuid);
    }

    protected function storeContainerInLocation() : void
    {
        (new ContainerLocationRepository)
            ->store(new ContainerLocationData(
                material_container_uuid: $this->data->container->uuid,
                storage_location_uuid: $this->data->location->uuid,
            ));
    }

    protected function createContainerEvent() : void
    {
        (new ContainerEventRepository)
            ->store(new ContainerEventData(
                material_container_uuid: $this->data->container->uuid,
                event_type: 'moved',
                event_data: [],
                occurred_at: Carbon::now(),
            ));
    }
}
