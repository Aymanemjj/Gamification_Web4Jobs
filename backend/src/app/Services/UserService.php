<?php

namespace App\Services;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\Role;

class UserService
{
    public function getAllUsers()
    {
        return User::all();
    }



    public function changeRole(User $user, Request $request) : User
    {

    
            $role = Role::where("name", $request->role)->first();
    
            $user->update([
                "role" => $role->id,
            ]);
            return $user;
    }

    public function toggleActive(User $user) : User
    {

            $user->update([
                "active" => !$user->active,
            ]);
            return $user;
    }
    

}
