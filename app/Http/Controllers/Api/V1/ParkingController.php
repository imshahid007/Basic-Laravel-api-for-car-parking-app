<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkingRequest;
use App\Http\Resources\ParkingResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Parking;
//
use App\Services\ParkingPriceService;

/**
 * @group Parking
 * @authenticated
 */
class ParkingController extends Controller
{
    //
    public function start(ParkingRequest $request): JsonResponse|ParkingResource
    {
        // Get validated data
        $parkingData = $request->validated();

        // Check if vehicle is already parked
        if (Parking::active()->where('vehicle_id', $request->vehicle_id)->exists()) {
            return response()->json([
                'errors' => ['general' => ['Vehicle already parked! Please end the current parking session before starting a new one.']],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //
        $parking = Parking::create($parkingData);
        $parking->load('vehicle', 'zone');

        return ParkingResource::make($parking);
    }


    public function show(Parking $parking): ParkingResource
    {
        return ParkingResource::make($parking);
    }


    public function stop(Parking $parking): ParkingResource | JsonResponse
{
    if($parking->stop_time) {
        return response()->json(['errors' => ['general' => ['Parking already stopped.']], ]
        , Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    $parking->update([
        'stop_time' => now(),
        'total_price' => ParkingPriceService::calculatePrice($parking->zone_id, $parking->start_time),
    ]);

    return ParkingResource::make($parking);
}
}
