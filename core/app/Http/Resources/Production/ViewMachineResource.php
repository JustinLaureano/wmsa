<?php

namespace App\Http\Resources\Production;

use App\Domain\Production\Enums\MachineTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewMachineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge($this->resource->toArray(), [
            'machine_type_label' => MachineTypeEnum::from(
                    $this->machine_type_name
                )
                ->label(),
        ]);
    }
}
