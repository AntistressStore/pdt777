<?php

namespace App\Http\Controllers;

use App\Filters\HouseFilter;
use App\Http\Requests\HouseRequest;
use App\Http\Resources\HouseResource;
use App\Services\HouseService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HouseController extends Controller
{
    public function index(HouseRequest $request, HouseFilter $filter, HouseService $service): AnonymousResourceCollection
    {
        return HouseResource::collection(
            $service->getFilteredHouses($filter)
        );
    }
}
