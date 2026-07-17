<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService) {}

    public function getAllRoles()
    {
        try {
            $roles = $this->roleService->getAllRoles();
            return response()->json([
                'success' => true,
                'data' => $roles,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getRoleByName(Request $request)
    {
        try {
            $role = $this->roleService->getRoleByName($request->name);
            return response()->json([
                'success' => true,
                'data' => $role,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function createRole(Request $request)
    {
        try {
            $role = $this->roleService->createRole($request->name);
            return response()->json([
                'success' => true,
                'data' => $role,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function updateRole(Request $request, $id)
    {
        try {
            $role = $this->roleService->updateRole($id, $request->name);
            return response()->json([
                'success' => true,
                'data' => $role,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function deleteRole($id)
    {
        try {
            $this->roleService->deleteRole($id);
            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
