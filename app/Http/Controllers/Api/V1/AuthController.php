<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        try {
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                $user   = $request->user();
                $token  = $user->createToken('pharmacy-system')->plainTextToken;

                return $this->success((new UserResource($user, $token)));
            }

            return $this->failed(['error' => 'The provided credentials are incorrect.']);
        } catch (Exception $e) {
            Log::error('Error while login a user', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return $this->failed();
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->success();
        } catch (Exception $e) {
            Log::error('Error while logout a user', ['error' => $e->getMessage(), 'trace' => $e->__toString()]);
            return $this->failed();
        }
    }
}
