<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
 * @group Auth
 *
 * @authenticated
 */
class PasswordUpdateController extends Controller
{
    //
    public function __invoke(UserPasswordRequest $request): JsonResponse
    {
        //
        auth()->user()->update([
            'password' => Hash::make($request->validated('password')),
        ]);

        //
        return response()->json([
            'message' => 'Password updated successfully',
        ], Response::HTTP_ACCEPTED);

    }
}
