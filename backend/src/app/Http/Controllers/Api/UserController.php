<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function getAllUsers(Request $request)
    {
        try {
            $users = $this->userService->getAllUsers();
            return response()->json([
                "success" => true,
                "data" => UserResource::collection($users),
            ]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    public function changeRole(User $user, Request $request)
    {
        try {
            $request->validate([
                "role" => "required|string|exists:roles,name",
            ]);
            $user = $this->userService->changeRole($user, $request);
    
            return response()->json([
                "success" => true,
                "data" => new UserResource($user),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "success" => false,
                "error" => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function toggleActive(User $user)
    {
        try {
            $user = $this->userService->toggleActive($user);
    
            return response()->json([
                "success" => true,
                "data" => new UserResource($user),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    
}
