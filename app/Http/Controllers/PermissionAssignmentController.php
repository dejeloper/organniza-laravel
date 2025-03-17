<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionAssignmentController extends Controller
{
    /**
     * Get the permissions of a role
     */
    public function getPermissionsOfRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = $role->permissions;
        return response()->json($permissions);
    }

    /**
     * Assign a permission to a role
     */
    public function assignPermissionToRole(Request $request, $roleId)
    {
        $permissionId = $request->permission;
        $role = Role::findOrFail($roleId);
        $permission = Permission::findOrFail($permissionId);
        if (!$role->hasPermissionTo($permission)) {
            $role->givePermissionTo($permission);
        }

        return response()->json(['message' => 'Permission assigned successfully to the role']);
    }

    /**
     * Remove a permission from a role
     */
    public function removePermissionFromRole(Request $request, $roleId)
    {
        $permissionId = $request->permission;
        $role = Role::findOrFail($roleId);
        $permission = Permission::findOrFail($permissionId);
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
        }

        return response()->json(['message' => 'Permission removed successfully from the role']);
    }

    /**
     * Get the permissions of a user
     */
    public function getPermissionsOfUser($userId)
    {
        $user = User::findOrFail($userId);
        $permissions = $user->getAllPermissions();
        return response()->json($permissions);
    }

    /**
     * Assign a permission to a user
     */
    public function assignPermissionToUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $permissionId = $request->permission;
        $permission = Permission::findOrFail($permissionId);
        if (!$user->hasPermissionTo($permission)) {
            $user->givePermissionTo($permission);
        }

        return response()->json(['message' => 'Permission assigned to user']);
    }

    /**
     * Remove a permission from a user
     */
    public function removePermissionFromUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $permissionId = $request->permission;
        $permission = Permission::findOrFail($permissionId);
        if (!$user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
        }

        return response()->json(['message' => 'Permission removed from user']);
    }
}
