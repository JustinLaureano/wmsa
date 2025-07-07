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
     * @param int $sequence_position
     * @param bool $is_sort_destination
     * @param bool $is_degas_destination
     * @param array $destination_order
     * @param StorageLocation $current_location
     */
    public function __construct(
        public MaterialContainer $materialContainer,
        public ?StorageLocation $preferred_destination,
        public Collection $available_destinations,
        public int $sequence_position,
        public bool $is_sort_destination,
        public bool $is_degas_destination,
        public array $destination_order,
        public object $current_location,
    ) {
    }
}
