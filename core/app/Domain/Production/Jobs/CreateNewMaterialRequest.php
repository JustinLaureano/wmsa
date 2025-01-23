<?php

namespace App\Domain\Production\Jobs;

use App\Domain\Production\DataTransferObjects\MaterialRequestActionData;
use App\Domain\Production\DataTransferObjects\MaterialRequestData;
use App\Domain\Production\Events\MaterialRequestCreated;
use App\Repositories\MaterialRequestRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class CreateNewMaterialRequest implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public MaterialRequestActionData $data,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $this->storeMaterialRequest();
            $this->createRequestEvent();
        });

        MaterialRequestCreated::dispatch();
    }

    protected function storeMaterialRequest() : void
    {
        (new MaterialRequestRepository)
            ->store(new MaterialRequestData(
                material_uuid: $this->data->material->uuid,
                quantity: $this->data->quantity,
                unit_of_measure: $this->data->unit_of_measure,
                machine_uuid: $this->data->machine?->uuid ?? null,
                storage_location_uuid: $this->data->location?->uuid ?? null,
                material_request_status_code: $this->data->material_request_status_code,
                requester_user_uuid: $this->data->requester->uuid,
                requested_at: $this->data->requested_at,
            ));
    }

    protected function createRequestEvent() : void
    {
        // (new ContainerEventRepository)
        //     ->store(new ContainerEventData(
        //         material_container_uuid: $this->data->container->uuid,
        //         event_type: 'moved',
        //         event_data: [],
        //         occurred_at: Carbon::now(),
        //     ));
    }
}
