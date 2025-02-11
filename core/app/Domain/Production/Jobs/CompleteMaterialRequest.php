<?php

namespace App\Domain\Production\Jobs;

use App\Domain\Production\Events\MaterialRequestCompleted;
use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\DataTransferObjects\Actions\UpdateMaterialRequestStatusActionData;
use App\Repositories\MaterialRequestRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompleteMaterialRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public UpdateMaterialRequestStatusActionData $data,
    ) {
        //
    }

    public function handle(MaterialRequestRepository $repository): void
    {
        $materialRequest = $repository->updateStatus(
            $this->data->materialRequest,
            RequestStatusEnum::COMPLETED->value
        );

        MaterialRequestCompleted::dispatch($materialRequest);
    }
}
