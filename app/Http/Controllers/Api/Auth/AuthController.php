<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthUser;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Undocumented function
     *
     * @param AuthUser $request
     * @return \App\Http\Resources\UserResource
     */
    public function auth(AuthUser $request)
    {
        $user = $this->model->where('email', $request->email)->firstOrFail();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais enviadas estão incorretas.'],
            ]);
        }

        return (new UserResource($user))
                    ->additional([
                        'token' => $user->createToken($request->device_name)->plainTextToken,
                    ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'logout' => 'success'
        ]);
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return \App\Http\Resources\UserResource
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return new UserResource($user);
    }
}
