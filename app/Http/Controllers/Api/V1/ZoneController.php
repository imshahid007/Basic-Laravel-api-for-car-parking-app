<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ZoneResource;
use App\Models\Zone;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Zones
 */
class ZoneController extends Controller
{
    //
    public function index(): AnonymousResourceCollection
    {
        return ZoneResource::collection(resource: Zone::paginate(10));
    }

    // not invokable controller as there might be methods in future
}
