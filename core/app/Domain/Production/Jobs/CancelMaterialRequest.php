<?php

namespace App\Domain\Production\Jobs;

use App\Domain\Production\Events\MaterialRequestCancelled;
use App\Domain\Production\Enums\RequestStatusEnum;
use App\Repositories\MaterialRequestRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CancelMaterialRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly string $uuid)
    {
    }

    public function handle(MaterialRequestRepository $repository): void
    {
        $materialRequest = $repository->updateStatus(
            $this->uuid,
            RequestStatusEnum::CANCELLED->value
        );

        MaterialRequestCancelled::dispatch($materialRequest);
    }
} 