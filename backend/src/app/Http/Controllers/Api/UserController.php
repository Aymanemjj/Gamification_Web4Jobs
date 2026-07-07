<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        
    }

    public function getAllUsers(Request $request)
    {
        try {
            $users = $this->userService->getAllUsers();
            return response()->json([
                "success" => true,
                "data" => UserResource::collection($users),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
