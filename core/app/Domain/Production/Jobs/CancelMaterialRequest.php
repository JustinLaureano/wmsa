<?php

namespace App\Domain\Production\Jobs;

use App\Domain\Production\Events\MaterialRequestCancelled;
use App\Domain\Production\Enums\RequestStatusEnum;
use App\Domain\Production\DataTransferObjects\UpdateMaterialRequestStatusData;
use App\Repositories\MaterialRequestRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CancelMaterialRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public UpdateMaterialRequestStatusData $data,
    ) {
        //
    }

    public function handle(MaterialRequestRepository $repository): void
    {
        $materialRequest = $repository->updateStatus(
            $this->data->materialRequest,
            RequestStatusEnum::CANCELLED->value
        );

        MaterialRequestCancelled::dispatch($materialRequest);
    }
} 