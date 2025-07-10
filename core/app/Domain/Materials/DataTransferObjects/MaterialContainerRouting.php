<?php

namespace App\Domain\Materials\DataTransferObjects;

use App\Models\MaterialContainer;
use App\Models\StorageLocation;
use Spatie\LaravelData\Data;
use Illuminate\Database\Eloquent\Collection;

class MaterialContainerRouting extends Data
{
    /**
     * @param MaterialContainer $materialContainer
     * @param StorageLocation|null $preferred_destination
     * @param Collection<StorageLocation>|null $available_destinations
     * @param int|null $route_building_id
     * @param int|null $sequence_position
     * @param bool $is_completion_destination
     * @param bool $is_sort_destination
     * @param bool $is_degas_destination
     * @param Collection<StorageLocation> $destination_order
     * @param StorageLocation $current_location
     */
    public function __construct(
        public MaterialContainer $materialContainer,
        public StorageLocation|null $preferred_destination,
        public Collection|null $available_destinations,
        public int|null $route_building_id,
        public int|null $sequence_position,
        public bool $is_completion_destination,
        public bool $is_sort_destination,
        public bool $is_degas_destination,
        public Collection $destination_order,
        public object $current_location,
    ) {
    }
}
