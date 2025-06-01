<?php

namespace App\Http\Resources\Materials;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MaterialInventoryCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = MaterialInventoryResource::class;

    public function setCollection($collection) {
        $this->collects = $collection;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->toArray(),
            'computed' => [
                'count' => $this->collection->count()
            ],
            'meta' => [
                'timestamp' => now()
            ],
        ];
    }
}
