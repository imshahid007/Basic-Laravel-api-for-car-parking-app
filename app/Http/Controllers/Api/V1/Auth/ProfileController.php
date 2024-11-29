<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    //
    public function show(Request $request)
    {
        return response()->json(UserResource::make($request->user()), Response::HTTP_OK);
    }
}
