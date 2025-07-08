<?php

namespace App\Repositories;

use App\Models\MaterialContainerMovement;

class MaterialContainerMovementRepository
{
    /**
     * Get the latest movement for a material container.
     */
    public function getLatestMovement(string $materialContainerUuid) : MaterialContainerMovement|null
    {
        return MaterialContainerMovement::where(
                'material_container_uuid',
                $materialContainerUuid
            )
                ->orderBy('moved_at', 'desc')
                ->first();
    }

    /**
     * Get the latest movement with a sequence for a material container.
     */
    public function getLatestSequenceMovement(string $materialContainerUuid) : MaterialContainerMovement|null
    {
        return MaterialContainerMovement::where(
                'material_container_uuid',
                $materialContainerUuid
            )
                ->whereNotNull('sequence')
                ->orderBy('moved_at', 'desc')
                ->first();
    }

    /**
     * Get the latest sequence number for a material container, or 0 if none exists.
     */
    public function getLatestSequence(string $materialContainerUuid) : int
    {
        return $this->getLatestSequenceMovement($materialContainerUuid)?->sequence ?? 0;
    }

    /**
     * Check if a material container has visited a sort location.
     */
    public function hasVisitedSortLocation(string $materialContainerUuid) : bool
    {
        return MaterialContainerMovement::where(
                'material_container_uuid',
                $materialContainerUuid
            )
            ->where('is_sort_location', true)
            ->exists();
    }

    /**
     * Check if a material container has visited a completion location.
     */
    public function hasVisitedCompletionLocation(string $materialContainerUuid) : bool
    {
        return MaterialContainerMovement::where(
                'material_container_uuid',
                $materialContainerUuid
            )
            ->where('is_completion_location', true)
            ->exists();
    }

    /**
     * Check if a material container has visited a degas location.
     */
    public function hasVisitedDegasLocation(string $materialContainerUuid) : bool
    {
        return MaterialContainerMovement::where(
                'material_container_uuid',
                $materialContainerUuid
            )
            ->where('is_degas_location', true)
            ->exists();
    }
}
