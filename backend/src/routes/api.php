<?php

use App\Http\Controllers\Api\PlatformControllers\AttendanceCenterEventController;
use App\Http\Controllers\Api\PlatformControllers\CertificationPlatformEventController;
use App\Http\Controllers\Api\PlatformControllers\DiscordEventController;
use App\Http\Controllers\Api\PlatformControllers\InsertionPlatformEventController;
use App\Http\Controllers\Api\PlatformControllers\Web4JobsPlatformEventController;
use App\Http\Controllers\Api\PlatformControllers\ManualContributionEventController;
use App\Http\Controllers\Api\CenterController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\UserController;
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
    Route::post("gamification/insertion/events", [
        InsertionPlatformEventController::class,
        "handleSingle",
    ])->name("events.insertionPlatform.single");
    Route::post("gamification/insertion/events/batch", [
        InsertionPlatformEventController::class,
        "handleBatch",
    ])->name("events.insertionPlatform.batch");

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

Route::put("gamification/events/{id}/status", [
    EventController::class,
    "updateStatus",
])->name("events.status.update");

Route::delete("gamification/events/{id}", [
    EventController::class,
    "delete",
])->name("events.delete");

Route::get("gamification/events", [
    EventController::class,
    "getAllEvents",
])->name("events.list");

Route::get("gamification/events/{id}", [
    EventController::class,
    "getEventById",
])->name("events.get");

Route::get("gamification/centers", [CenterController::class, "index"])->name(
    "centers.list",
);

Route::get("gamification/centers/{id}", [
    CenterController::class,
    "show",
])->name("centers.get");

Route::post("gamification/centers", [CenterController::class, "create"])->name(
    "centers.create",
);

Route::put("gamification/centers/{id}", [
    CenterController::class,
    "update",
])->name("centers.update");

Route::delete("gamification/centers/{id}", [
    CenterController::class,
    "delete",
])->name("centers.delete");

Route::put("gamification/centers/{id}/add/{userId}", [
    CenterController::class,
    "addUser",
])->name("centers.addUser");
Route::put("gamification/centers/{id}/remove/{userId}", [
    CenterController::class,
    "removeUser",
])->name("centers.removeUser");


//Users
Route::get("gamification/admin/users/getall", [
    UserController::class,
    "getAllUsers",
])->name("users.list");

Route::put("gamification/admin/users/{user}/change-role", [
    UserController::class,
    "changeRole",
])->name("users.changeRole");

Route::put("gamification/admin/users/{user}/togle-active", [
    UserController::class,
    "toggleActive",
])->name("users.toggleActive");


//Roles
Route::get("gamification/admin/roles/getall",[
RoleController::class,
'getAllRoles'
])->name("roles.getAll");