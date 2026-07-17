<?php

namespace App\Services;

class RoleService
{
    public function getAllRoles()
    {
        return \App\Models\Role::all();
    }

    public function getRoleByName($name)
    {
        return \App\Models\Role::where('name', $name)->first();
    }

    public function createRole($name)
    {
        return \App\Models\Role::create(['name' => $name]);
    }

    public function updateRole($id, $name)
    {
        $role = \App\Models\Role::find($id);
        $role->name = $name;
        $role->save();
        return $role;
    }

    public function deleteRole($id)
    {
        $role = \App\Models\Role::find($id);
        $role->delete();
        return $role;
    }
}
