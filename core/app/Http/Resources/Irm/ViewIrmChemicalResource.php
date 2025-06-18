<?php

namespace App\Http\Resources\Irm;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewIrmChemicalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->resource->toArray();
    }
}
