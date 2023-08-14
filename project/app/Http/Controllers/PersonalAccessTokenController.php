<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalTokenRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use \Illuminate\Http\JsonResponse;

class PersonalAccessTokenController extends Controller
{
    public function getToken(PersonalTokenRequest $request): JsonResponse
    {
        $user = (new UserRepository())->getByColumn($request->email,'email');
        if(! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email'=>['The provided credentials are incorrect.']
            ]);
        }
        return response()->json([
            'message'=>'Success',
            'data'=> $user->createToken($request->email)->plainTextToken
        ], 200);
    }
}
