<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Uses the given trait in the current file
uses(RefreshDatabase::class);

test('It can login the user with correct credentials', closure: function () {
    $user = User::factory()->create();

    $response = $this->postJson('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertStatus(201);
});

//
test('It cannot login the user with incorrect credentials', closure: function () {
    $user = User::factory()->create();

    $response = $this->postJson('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'wrong_password',
    ]);

    $response->assertStatus(422);
});

//
test('It can register the user with correct credentials', closure: function () {
    //
    $response = $this->postJson('/api/v1/auth/register', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'access_token',
        ]);

    $this->assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});

//
//
test('It cannot register the user with incorrect credentials', closure: function () {
    //
    $response = $this->postJson('/api/v1/auth/register', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'password_confirmation' => 'wrong_password',
    ]);

    $response->assertStatus(422);

    $this->assertDatabaseMissing('users', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});
