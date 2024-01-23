<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPermissionsUser;
use App\Http\Resources\PermissionResource;

class PermissionUserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->middleware('can:users');
    }

    public function permissionUser(string $identify)
    {
        $user = $this->user
                        ->where('uuid', $identify)
                        ->with('permissions')
                        ->firstOrFail();

        return PermissionResource::collection($user->permissions);
    }

    public function addPermissionUser(AddPermissionsUser $request)
    {
        $user = $this->user->where('uuid', $request->user)->firstOrFail();

        $user->permissions()->attach($request->permissions);

        return response()->json(['message' => 'Sucesso']);
    }


    public function userHasPermission(Request $request, $permission)
    {
        $user = $request->user();

        if (!$user->isSuperAdmin() && !$user->hasPermission($permission)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['message' => 'Authorized']);
    }
}
