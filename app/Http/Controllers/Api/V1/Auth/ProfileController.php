<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UserProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    //
    public function show(Request $request): JsonResponse
    {
        return response()->json(UserResource::make($request->user()), Response::HTTP_OK);
    }

    public function update(UserProfileRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        // Update user profile
        auth()->user()->update(attributes: $validatedData);

        return response()->json(UserResource::make($request->user()), Response::HTTP_ACCEPTED);
    }
}
