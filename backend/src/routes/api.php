<?php

use App\Http\Controllers\Api\PlatformControllers\AttendanceCenterEventController;
use App\Http\Controllers\Api\PlatformControllers\CertificationPlatformEventController;
use App\Http\Controllers\Api\PlatformControllers\DiscordEventController;
use App\Http\Controllers\Api\PlatformControllers\InsertionPlatformEventController;
use App\Http\Controllers\Api\PlatformControllers\Web4JobsPlatformEventController;
use App\Http\Controllers\Api\PlatformControllers\ManualContributionEventController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("PlatformAuth")->group(function () {

    //W4J
    Route::post("gamification/web4jobs/events", [
        Web4JobsPlatformEventController::class,
        "handleSingleEvent",
    ])->name("events.web4jobs.single");
    Route::post("gamification/web4jobs/events/batch", [
        Web4JobsPlatformEventController::class,
        "handleEventsBatch",
    ])->name("events.web4jobs.batch");

    //Manual contribution
    Route::post("gamification/manual-contributions/events", [
        ManualContributionEventController::class,
        "handleSingleEvent",
    ])->name("events.manualContribution.single");
    Route::post("gamification/manual-contributions/events/batch", [
        ManualContributionEventController::class,
        "handleEventBatch",
    ])->name("events.manualContribution.batch");

    //Insertion platform
    Route::post("gamification/insertino/events", [
        InsertionPlatformEventController::class,
        "handleSingleEvent",
    ])->name("events.insertionPlatform.single");
    Route::post("gamification/insertion/events", [
        InsertionPlatformEventController::class,
        "handleSingleEvent",
    ])->name("events.InsertionPlatform.batch");

    //Discord
    Route::post("gamification/forum/events", [
        DiscordEventController::class,
        "handleSingleEvent",
    ])->name("events.forumEvent.single");
    Route::post("gamification/forum/events/batch", [
        DiscordEventController::class,
        "handleEventBatch",
    ])->name("events.forumEvent.batch");
    Route::post("gamification/forum/daily-stats", [
        DiscordEventController::class,
        "handleDailyEvent",
    ])->name("events.forumEvent.daily");   

    //Certification Platform
    Route::post("gamification/certifications/events", [
        CertificationPlatformEventController::class,
        "handleEventBatch",
    ])->name("events.certificationPlatform.single");
    Route::post("gamification/certification/events/batch", [
        CertificationPlatformEventController::class,
        "handleEventBatch",
    ])->name("events.certificationPlatform.batch");

    //Center
    Route::post("gamification/attendance/events", [
       AttendanceCenterEventController::class,
        "handleEventBatch",
    ])->name("events.attendance.single");   
    Route::post("gamification/attendance/events/batch", [
        AttendanceCenterEventController::class,
        "handleEventBatch",
    ])->name("events.attendance.batch");
});
