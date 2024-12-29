<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // code directly in route only for test. In prod in separate controller
    return view('houses');
});
