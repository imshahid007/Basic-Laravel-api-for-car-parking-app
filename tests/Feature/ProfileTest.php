<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Uses the given trait in the current file
uses(RefreshDatabase::class);

//
test('It can get the user profile', closure: function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->getJson('/api/v1/profile');

    $response->assertStatus(200)
        ->assertJsonStructure(['name', 'email'])
        ->assertJsonCount(5)
        ->assertJsonFragment(['name' => $user->name]);
});

//
test('It can update the user name and email', closure: function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->putJson('/api/v1/profile', [
        'name' => 'John Updated',
        'email' => 'john_updated@example.com',
    ]);

    $response->assertStatus(202)
        ->assertJsonStructure(['name', 'email'])
        ->assertJsonCount(5)
        ->assertJsonFragment(['name' => 'John Updated']);

    $this->assertDatabaseHas('users', [
        'name' => 'John Updated',
        'email' => 'john_updated@example.com',
    ]);
});

//
test('It can update the user password', closure: function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->putJson('/api/v1/password', [
        'current_password' => 'password',
        'password' => 'testing123',
        'password_confirmation' => 'testing123',
    ]);

    $response->assertStatus(202);
});
