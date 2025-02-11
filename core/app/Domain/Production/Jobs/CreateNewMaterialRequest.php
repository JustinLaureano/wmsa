<?php

namespace App\Domain\Production\Jobs;

use App\Domain\Production\DataTransferObjects\Actions\MaterialRequestActionData;
use App\Domain\Production\DataTransferObjects\MaterialRequestData;
use App\Domain\Production\Events\MaterialRequestCreated;
use App\Domain\Production\Jobs\AttemptRequestContainerAllocation;
use App\Models\MaterialRequest;
use App\Repositories\MaterialRequestRepository;
use App\Repositories\MaterialRequestItemRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class CreateNewMaterialRequest implements ShouldQueue
{
    use Queueable;

    protected MaterialRequest $materialRequest;

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

        AttemptRequestContainerAllocation::dispatch($this->materialRequest);
    }

    protected function storeMaterialRequest() : void
    {
        DB::beginTransaction();

        $this->materialRequest = (new MaterialRequestRepository)
            ->store(new MaterialRequestData(
                material_request_status_code: $this->data->material_request_status_code,
                requester_user_uuid: $this->data->requester->uuid,
                requested_at: $this->data->requested_at,
            ));

        (new MaterialRequestItemRepository)
            ->collectionInsert($this->materialRequest, $this->data->items);

        DB::commit();
    }

    protected function createRequestEvent() : void
    {
        // (new MaterialRequestEventRepository)
        //     ->store(new MaterialRequestEventData(
        //         material_request_uuid: $this->materialRequest->uuid,
        //         event_type: 'created',
        //         event_data: [],
        //         occurred_at: Carbon::now(),
        //     ));
    }
}
