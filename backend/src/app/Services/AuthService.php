<?php

namespace App\Services;

use App\Models\User;
use App\DTOs\LoginDTO;
use App\DTOs\UserDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Role;

class AuthService
{
    private function attemptLogin(LoginDTO $loginDTO): ?array
    {
        $url = config("services.w4jauth.login_url"); // Pointing to http://localhost:4000/api

        try {
            $response = Http::timeout(5)->post(
                $url . "/login",
                $loginDTO->toArray(),
            );

            Log::debug("Node status code: " . $response->status());
            Log::debug("Node raw response payload: " . $response->body());

            if ($response->successful() && $response->json("success")) {
                return $response->json("data");
            }
            return null;
        } catch (\Exception $e) {
            Log::error("W4JAuth connection failed: " . $e->getMessage());
            return null;
        }
    }

    public function login(LoginDTO $loginDTO)
    {
        $user = User::where("email", $loginDTO->email)->first();

        // If user doesn't exist locally, check external node service
        if (!$user) {
            $externalUserData = $this->attemptLogin($loginDTO);

            if (!$externalUserData) {
                Log::info("Sending to Node:", $loginDTO->toArray());
                return response()->json(
                    ["success" => false, "message" => "Invalid credentials."],
                    401,
                );
            }

            // Provision user locally using node details
            $role = Role::where("name", $externalUserData["role"])->first();
            if (!$role) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Invalid role.",
                        "role" => $externalUserData["role"],
                    ],
                    400,
                );
            }

            $user = User::create([
                "firstname" => $externalUserData["firstname"],
                "lastname" => $externalUserData["lastname"],
                "email" => $externalUserData["email"],
                "role_id" => $role->id,
            ]);
        }

        // Authenticate locally via Sanctum tokens
        $token = $user->createToken("Gamification")->plainTextToken;
        return response()->json(
            [
                "success" => true,
                "message" => "Logged in successfully.",
                "data" => [
                    "token" => $token,
                    "user" => UserDTO::make([
                        "firstname" => $user->firstname,
                        "lastname" => $user->lastname,
                        "email" => $user->email,
                        "role" => $user->role->name,
                    ]),
                ],
            ],
            200,
        );
    }

    public function logout()
    {
        $user = Auth::user();
    
        if ($user) {
            $user->currentAccessToken()?->delete();
        }
    
        return response()->json(
            [
                "success" => true,
                "message" => "Logged out successfully.",
            ],
            200,
        );
    }

    /**
     * This endpoint fixes your "infoZustland" requirement.
     * React hits this route automatically on app load with its stored Bearer token.
     */
     public function infoZustland()
     {
         $user = Auth::user();
     
         return response()->json(
             [
                 "success" => true,
                 "message" => "User profile synced.",
                 "data" => [
                     "user" => $user ? UserDTO::make([
                         "firstname" => $user->firstname,
                         "lastname"  => $user->lastname,
                         "email"     => $user->email,
                         "role"      => $user->role?->name,
                     ]) : null,
                 ],
             ],
             200,
         );
     }
}
