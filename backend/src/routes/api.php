<?php

use App\Http\Controllers\Api\PlatformControllers\Web4JobsPlatformEventController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("PlatformAuth")->group(function () {
    Route::post("gamification/web4jobs/events", [
        Web4JobsPlatformEventController::class,
        "handleSingleEvent",
    ])->name("events.web4jobs.single");
    Route::post("gamification/web4jobs/events/batch", [
        Web4JobsPlatformEventController::class,
        "handleEventsBatch",
    ])->name("events.web4jobs.batch");
});
