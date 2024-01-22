<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;

class PermissionUserController extends Controller
{
    public function permissionUser(Request $request)
    {
        $permissions = $request->user()->permissions()->get();

        return PermissionResource::collection($permissions);
    }
}
