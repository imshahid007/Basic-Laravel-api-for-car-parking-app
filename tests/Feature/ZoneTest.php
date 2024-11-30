<?php

use Database\Seeders\ZoneSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Uses the given trait in the current file
uses(RefreshDatabase::class);

beforeEach(function () {
    // Run the database seeder
    $this->seed(ZoneSeeder::class);
});

//
test('It can check that public user get all zones', closure: function () {
    $response = $this->getJson('/api/v1/zones');

    $response->assertStatus(200)
        ->assertJsonStructure(['data'])
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure(['data' => [
            ['*' => 'id', 'name', 'price_per_hour'],
        ]])
        ->assertJsonPath('data.0.id', 1)
        ->assertJsonPath('data.0.name', 'Green Zone')
        ->assertJsonPath('data.0.price_per_hour', 5);
});
