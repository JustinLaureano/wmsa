<?php

namespace App\Http\Resources\Materials;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarcodeInformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'barcode' => new MaterialBarcodeResource($this->resource->barcode),
            'container' => new MaterialContainerResource($this->resource->container),
            'type' => $this->resource->type,
        ];
    }
}
