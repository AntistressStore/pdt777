<?php

namespace App\Services;

use App\Filters\HouseFilter;
use App\Models\House;

class HouseService
{
    public function getFilteredHouses(HouseFilter $filter): array
    {
        return [
            'houses' => House::query()
                ->filter($filter)
                ->paginate(50),
        ];
    }
}
