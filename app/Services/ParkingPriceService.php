<?php

namespace App\Services;

use App\Models\Zone;
use Carbon\Carbon;

class ParkingPriceService
{
    public static function calculatePrice(int $zone_id, string $startTime, ?string $stopTime = null): int|float
    {
        $start = new Carbon($startTime);
        $stop = (! is_null($stopTime)) ? new Carbon($stopTime) : now();

        $totalTimeByMinutes = $start->diffInMinutes(date: $stop);

        $priceByMinutes = Zone::find($zone_id)->price_per_hour / 60;
        // Calculate the total price

        return number_format($priceByMinutes * $totalTimeByMinutes, 2, '.', '');
    }
}
