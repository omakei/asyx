<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(UserFormRequest $request)
    {

        $user = User::create($request->only(['name','email','password','email_verified_at']));

        return response()
            ->json(
                UserResource::make($user),
                Response::HTTP_CREATED
            );
    }

    public function login(LoginFormRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!Hash::check($request->password, $user->password)) {

            return response()
                ->json(
                    null,
                    Response::HTTP_UNAUTHORIZED
                );
        }

       $token = $user->createToken('api-token',[
            'place:read',
            'place:create',
            'place:update',
            'place:delete',
        ])->plainTextToken;

        $user->token = $token;

        return response()
            ->json(
                UserResource::make($user),
                Response::HTTP_OK
            );
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()
            ->json(
                null,
                Response::HTTP_NO_CONTENT
            );
    }
}
