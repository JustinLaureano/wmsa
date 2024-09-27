<?php

namespace App\Support;

use App\Models\SkidItem;

class BuildingArea
{
    public function __construct(
        public string $area,
        public int $building
    ){
        //
    }

    public static function getRandomForSkidItem(SkidItem $item) : self
    {
        $building = 1;
        $area = 'WIP';

        if (
            $item->buildingOneArea &&
            $item->buildingTwoArea &&
            $item->buildingThreeArea
        ) {
            $buildings = [1, 2, 3];
            $building = $buildings[array_rand($buildings)];
        }
        else if (
            $item->buildingOneArea &&
            $item->buildingTwoArea &&
            !$item->buildingThreeArea
        ) {
            $buildings = [1, 2];
            $building = $buildings[array_rand($buildings)];
        }
        else if (
            $item->buildingOneArea &&
            $item->buildingThreeArea &&
            !$item->buildingTwoArea
        ) {
            $buildings = [1, 3];
            $building = $buildings[array_rand($buildings)];
        }
        else if (
            $item->buildingTwoArea &&
            $item->buildingThreeArea &&
            !$item->buildingOneArea
        ) {
            $buildings = [2, 3];
            $building = $buildings[array_rand($buildings)];
        }
        else if (
            $item->buildingTwoArea &&
            !$item->buildingThreeArea &&
            !$item->buildingOneArea
        ) {
            $building = 2;
        }
        else if (
            $item->buildingThreeArea &&
            !$item->buildingOneArea &&
            !$item->buildingTwoArea
        ) {
            $building = 3;
        }

        $area = match($building) {
            1 => $item->buildingOneArea->location,
            2 => $item->buildingTwoArea->location,
            3 => $item->buildingThreeArea->location
        };

        return new self($area, $building);
    }
}
