<?php

namespace App\Services;

use App\Http\Resources\LeagueResource;
use App\Models\League;
use App\Models\Learner;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LeagueService
{
    public function listAllLeagues(): JsonResponse
    {
        return response()->json(
            [
                "data" => LeagueResource::collection(League::all()),
            ],
            200,
        );
    }

    public function showLeagueDetails(League $league): JsonResponse
    {
        return response()->json(
            [
                "data" => LeagueResource::make($league),
            ],
            200,
        );
    }

    public function createLeague(array $data): JsonResponse
    {
        return response()->json(
            [
                "data" => LeagueResource::make(League::create($data)),
            ],
            201,
        );
    }

    public function updateLeague(League $league, array $data): JsonResponse
    {
        $league->update($data);
        return response()->json(
            [
                "data" => LeagueResource::make($league),
            ],
            200,
        );
    }

    public function deleteLeague(League $league): Response
    {
        $league->delete();
        return response()->noContent();
    }

    public static function reCheck(User $user): void{
        $xp = $user->stats->xp;

        $league = League::where('min_xp', '<=', $xp)
            ->orderByDesc('min_xp')
            ->first();

        if($league){
            $league = League::orderBy("max_xp", "desc")->first();
        }

        $user->league_id = $league->id;
        $user->save();
    }
}
