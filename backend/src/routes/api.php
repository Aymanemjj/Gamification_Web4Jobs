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
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\MetricKeyController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\LeaderBoardController;


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

Route::put("gamification/admin/events/{id}/status", [
    EventController::class,
    "updateStatus",
])->name("events.status.update");

Route::delete("gamification/admin/events/{id}", [
    EventController::class,
    "delete",
])->name("events.delete");

Route::get("gamification/admin/events", [
    EventController::class,
    "getAllEvents",
])->name("events.list");

Route::get("gamification/admin/events/{id}", [
    EventController::class,
    "getEventById",
])->name("events.get");

Route::get("gamification/admin/centers", [
    CenterController::class,
    "index",
])->name("centers.list");

Route::get("gamification/admin/centers/{id}", [
    CenterController::class,
    "show",
])->name("centers.get");

Route::post("gamification/admin/centers", [
    CenterController::class,
    "create",
])->name("centers.create");

Route::put("gamification/admin/centers/{id}", [
    CenterController::class,
    "update",
])->name("centers.update");

Route::delete("gamification/admin/centers/{id}", [
    CenterController::class,
    "delete",
])->name("centers.delete");

Route::put("gamification/admin/centers/{id}/add/{userId}", [
    CenterController::class,
    "addUser",
])->name("centers.addUser");
Route::put("gamification/admin/centers/{id}/remove/{userId}", [
    CenterController::class,
    "removeUser",
])->name("centers.removeUser");



//Login
Route::post("gamification/login", [AuthController::class, "login"])->name("auth.login");

/**
 * Authenticated routes
 */
Route::middleware("auth:sanctum")->group(function () {
    
    //Auth
    Route::post("gamification/logout", [AuthController::class, "logout"])->name(
        "auth.logout",
    );
    Route::get("gamification/info-zustland", [AuthController::class, "infoZustland"])->name(
        "auth.infoZustland",
    );

    Route::get("gamification/leaderboard/alltime", [
        LeaderBoardController::class,
        "getAllTimeLeaderboard",
    ])->name("leaderboard.allTime");

    Route::get("gamification/leaderboard/weekly", [
        LeaderBoardController::class,
        "getWeeklyLeaderboard",
    ])->name("leaderboard.weekly");

    Route::get("gamification/leaderboard/monthly", [
        LeaderBoardController::class,
        "getMonthlyLeaderboard",
    ])->name("leaderboard.monthly");

    /**
     * Admin routes
     */
    Route::middleware("isAdmin")->group(function () {
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
        Route::get("gamification/admin/roles/getall", [
            RoleController::class,
            "getAllRoles",
        ])->name("roles.getAll");

        Route::post("gamification/admin/roles", [
            RoleController::class,
            "createRole",
        ])->name("roles.create");

        Route::put("gamification/admin/roles/{id}", [
            RoleController::class,
            "updateRole",
        ])->name("roles.update");

        Route::delete("gamification/admin/roles/{id}", [
            RoleController::class,
            "deleteRole",
        ])->name("roles.delete");

        
        //AdminStats
        Route::get('gamification/admin/basic-stats', [
        AdminController::class,
        "basicStats"
        ])->name("admin.basicStats");

        //MetricKeys
        Route::get("gamification/admin/metric-keys/getall", [
            MetricKeyController::class,
            "getAllMetricKeys",
        ])->name("metric-keys.getAll");

        Route::get("gamification/admin/metric-keys/{id}", [
            MetricKeyController::class,
            "getMetricKeyById",
        ])->name("metric-keys.get");
        

        Route::post("gamification/admin/metric-keys", [
            MetricKeyController::class,
            "createMetricKey",
        ])->name("metric-keys.create");

        Route::put("gamification/admin/metric-keys/{id}", [
            MetricKeyController::class,
            "updateMetricKey",
        ])->name("metric-keys.update");

        Route::delete("gamification/admin/metric-keys/{id}", [
            MetricKeyController::class,
            "deleteMetricKey",
        ])->name("metric-keys.delete");
    });
});
