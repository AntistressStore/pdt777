<?php

namespace App\Http\Controllers;

use App\Http\Requests\HouseRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\HouseResource;


class HouseController extends Controller
{
    public function index(HouseRequest $request, HouseFilter $filter, HouseService $service): AnonymousResourceCollection
    {
        return HouseResource::collection(
            $service->getFilteredHouses($filter)
        );
    }
}
