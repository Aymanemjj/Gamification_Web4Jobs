<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\StoreBadgeRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Http\Requests\UpdateBadgeRequest;
use App\Models\Achievement;
use App\Models\Badge;
use App\Services\BadgeService;
use Exception;

class BadgeController extends Controller
{
    public function __construct(private BadgeService $badgeService) {}

    public function index()
    {
        try {
            return $this->badgeService->listAllBadges();
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function show(Badge $badge)
    {
        try {
            return $this->badgeService->showBadgeDetails($badge);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function store(StoreBadgeRequest $request)
    {
        try {
            return $this->badgeService->createBadge($request->validated());
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function update(UpdateBadgeRequest $request, Badge $badge)
    {
        try {
            return $this->badgeService->updateBadge(
                $badge,
                $request->validated(),
            );
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function destroy(Badge $badge)
    {
        try {
            return $this->badgeService->deleteBadge($badge);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
}
