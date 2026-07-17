<?php

namespace App\Http\Controllers\Api;

use App\Services\LeaderBoardService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaderBoardController extends Controller
{
    public function __construct(
        private LeaderBoardService $leaderBoardService,
    ) {}

    public function getAllTimeLeaderboard(Request $request) {
        try {
            $leaderboard = $this->leaderBoardService->getAllTimeLeaderboard();
            return response()->json([
            'success' => true,
            'data' => $leaderboard,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getWeeklyLeaderboard(Request $request) {
        try {
            $leaderboard = $this->leaderBoardService->getWeeklyLeaderboard();
            return response()->json([
            'success' => true,
            'data' => $leaderboard,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getMonthlyLeaderboard(Request $request) {
        try {
            $leaderboard = $this->leaderBoardService->getMonthlyLeaderboard();
            return response()->json([
            'success' => true,
            'data' => $leaderboard,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
