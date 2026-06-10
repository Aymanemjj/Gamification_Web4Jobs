<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeagueRequest;
use App\Http\Requests\UpdateLeagueRequest;
use App\Models\League;
use App\Services\LeagueService;
use Exception;

class LeagueController extends Controller
{
    public function __construct(private LeagueService $leagueService) {}

    public function index()
    {
        try {
            return $this->leagueService->listAllLeagues();
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function show(League $league)
    {
        try {
            return $this->leagueService->showLeagueDetails($league);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function store(StoreLeagueRequest $request)
    {
        try {
            return $this->leagueService->createLeague($request->validated());
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function update(UpdateLeagueRequest $request, League $league)
    {
        try {
            return $this->leagueService->updateLeague(
                $league,
                $request->validated(),
            );
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function destroy(League $league)
    {
        try {
            return $this->leagueService->deleteLeague($league);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
}
