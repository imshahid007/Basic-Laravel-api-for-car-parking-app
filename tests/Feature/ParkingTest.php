<?php

use App\Models\Parking;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Zone;
use Database\Seeders\ZoneSeeder;
//
use Illuminate\Foundation\Testing\RefreshDatabase;

//
uses(RefreshDatabase::class);

//
beforeEach(function () {
    // Run the database seeder
    $this->seed(ZoneSeeder::class);
});

//
test('It allow user to start the parking', closure: function () {
    $user = User::factory()->create();
    $vehicle = Vehicle::factory()->create(['user_id' => $user->id]);
    $zone = Zone::first();

    $response = $this->actingAs($user)->postJson('/api/v1/parkings/start', [
        'vehicle_id' => $vehicle->id,
        'zone_id' => $zone->id,
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure(['data'])
        ->assertJson([
            'data' => [
                'start_time' => now()->toDateTimeString(),
                'stop_time' => null,
                'total_price' => 0,
            ],
        ]);

    $this->assertDatabaseCount('parkings', '1');
});

//
test('It can get ongoing car parking price', closure: function () {
    $user = User::factory()->create();
    $vehicle = Vehicle::factory()->create(['user_id' => $user->id]);
    $zone = Zone::first();

    $this->actingAs($user)->postJson('/api/v1/parkings/start', [
        'vehicle_id' => $vehicle->id,
        'zone_id' => $zone->id,
    ]);

    $this->travel(2)->hours();

    $parking = Parking::first();
    $response = $this->actingAs($user)->getJson('/api/v1/parkings/'.$parking->id);

    $response->assertStatus(200)
        ->assertJsonStructure(['data'])
        ->assertJson([
            'data' => [
                'stop_time' => null,
                'total_price' => $zone->price_per_hour * 2,
            ],
        ]);
});

//
test('It can stop car parking', closure: function () {
    $user = User::factory()->create();
    $vehicle = Vehicle::factory()->create(['user_id' => $user->id]);
    $zone = Zone::first();

    $this->actingAs($user)->postJson('/api/v1/parkings/start', [
        'vehicle_id' => $vehicle->id,
        'zone_id' => $zone->id,
    ]);

    $this->travel(2)->hours();

    $parking = Parking::first();
    $response = $this->actingAs($user)->putJson('/api/v1/parkings/'.$parking->id);

    $updatedParking = Parking::find($parking->id);

    $response->assertStatus(200)
        ->assertJsonStructure(['data'])
        ->assertJson([
            'data' => [
                'start_time' => $updatedParking->start_time->toDateTimeString(),
                'stop_time' => $updatedParking->stop_time->toDateTimeString(),
                'total_price' => $updatedParking->total_price,
            ],
        ]);

    $this->assertDatabaseCount('parkings', '1');
});
