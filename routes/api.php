<?php

use App\Http\Controllers\HouseController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'houses' => HouseController::class,
])
// If the request is for registered users only we need write auth and guard it with auth
// ->middleware('auth:sanctum')
;

