<?php

namespace App\Services;

use App\Dtos\CollageDTO;
use App\Dtos\LoginDTO;
use App\Dtos\PieceDTO;
use App\Dtos\UserDTO;
use App\Http\Resources\AuthResource;
use App\Models\Collage;
use App\Models\Piece;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class AuthService
{

    private function attemptLogin(LoginDTO $loginDTO): bool
    {
        $url = config('services.w4jauth.login_url');
    
        try {
            $response = Http::timeout(5)->post($url, $loginDTO->toArray());
    
            if ($response->successful()) {
                return (bool) $response->json('authenticated'); 
            }
    
            return false;
        } catch (\Exception $e) {
            Log::error('W4JAuth login connection failed: ' . $e->getMessage());
            return false;
        }
    }
    
    private function getInfo(LoginDTO $loginDTO): ?array
    {
        $url = config('services.w4jauth.info_url');
    
        try {
            $response = Http::timeout(5)->post($url, $loginDTO->toArray());
    
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['email']) && isset($data['name'])) {
                    return [
                        'firstname'  => $data['firstname'],
                        'lastname' => $data['lastname'],
                        'email' => $data['email'],
                        'password' => $data['password'],
                    ];
                }
            }
    
            return null;
        } catch (\Exception $e) {
            Log::error('W4JAuth getInfo connection failed: ' . $e->getMessage());
            return null;
        }
    }


    public function login(LoginDTO $loginDTO)
    {
        $user = User::where('email', $loginDTO->email)->first();
    
        if ($user) {
            $token = $user->createToken('Gamification')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Logedin seccesfully.',
                'data' =>  ["token" => $token, 'user' => UserDTO::make($user)]
            ], 200);        }
    
        $isAuthenticated = $this->attemptLogin($loginDTO);
    
        if (!$isAuthenticated) {
            return response()->json(['message' => 'Invalid credentials via W4JAuth.'], 401);
        }
    
        $userData = $this->getInfo($loginDTO);
    
        if (!$userData) {
            return response()->json(['message' => 'Failed to retrieve user profile from external system.'], 500);
        }
    
        try {
            $newUser = User::create([
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'],
                'email' => $userData['email'],
                'password' => $userData['password'], 
            ]);
    
            $token = $user->createToken('Gamification')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Logedin seccesfully.',
                'data' =>  ["token" => $token, 'user' => UserDTO::make($newUser)]
            ], 200);        
        
        } catch (\Exception $e) {
            Log::error('Failed to provision local user: ' . $e->getMessage());
            return response()->json(['message' => 'Server error during registration.'], 500);
        }
    }


    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'LogedOut seccesfully.',
        ], 200);
    }

    public function profile()
    {

        $pieces = Piece::with(['tags', 'owner'])
            ->where('administered', false)
            ->where('user_id', Auth::id())
            ->get();

        $collages = Collage::with(['pieces.tags', 'owner'])
            ->where('administered', false)
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Profil utilisateur récupéré',
            'data' => ["user" => UserDTO::make(Auth::user()), 'pieces' => PieceDTO::collection($pieces), 'collages' => CollageDTO::collection($collages)],
        ], 200);
    }


    public function profilePinia($request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Profil utilisateur récupéré',
            'data' => ["user" => UserDTO::make(Auth::user())],
        ], 200);
    }
}
