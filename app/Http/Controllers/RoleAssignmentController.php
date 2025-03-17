<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RoleAssignmentController extends Controller
{
    /**
     * Get the roles of a user
     */
    public function getRolesOfUser($userId)
    {
        $user = User::findOrFail($userId);
        $roles = $user->roles;
        return response()->json($roles);
    }

    /**
     * Assign roles to a user
     */
    public function assignRolesToUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $roles = $request->roles;
        $user->syncRoles($roles);
        return response()->json(['message' => 'Roles assigned successfully']);
    }

    /**
     * Remove roles from a user
     */
    public function removeRolesFromUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $roles = $request->roles;
        $user->removeRole($roles);
        return response()->json(['message' => 'Roles removed successfully']);
    }
}
