<?php

namespace App\Services;

use App\Http\Resources\BadgeResource;
use App\Models\Badge;
use App\Models\Learner;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class BadgeService
{
    public function listAllBadges(): JsonResponse
    {
        return response()->json(
            [
                "data" => BadgeResource::collection(Badge::all()),
            ],
            200,
        );
    }

    public function showBadgeDetails(Badge $badge): JsonResponse
    {
        return response()->json(
            [
                "data" => BadgeResource::make($badge),
            ],
            200,
        );
    }

    public function createBadge(array $data): JsonResponse
    {
        return response()->json(
            [
                "data" => BadgeResource::make(Badge::create($data)),
            ],
            201,
        );
    }

    public function updateBadge(Badge $badge, array $data): JsonResponse
    {
        $badge->update($data);
        return response()->json(
            [
                "data" => BadgeResource::make($badge),
            ],
            200,
        );
    }

    public function deleteBadge(Badge $badge): Response
    {
        $badge->delete();
        return response()->noContent();
    }

    public static function reCheck(Learner $learner){
        {
            
        }
    }
}
