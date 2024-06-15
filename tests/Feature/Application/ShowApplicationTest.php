<?php

use App\Models\Application;
use App\Models\User;

test('Users can view their own show page', function () {

    $user = User::factory()->create();
    $application = Application::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->get(route('applications.show', $application));

    $response->assertStatus(200);
    $response->assertSee($application->id);
    $response->assertSee($application->secret_key);
});

test('Users cannot view other users show page', function () {

    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $application = Application::factory()->create([
        'user_id' => $otherUser->id,
    ]);

    $response = $this->actingAs($user)->get(route('applications.show', $application));

    $response->assertStatus(403);
});

test('Guests cannot view show page', function () {

    $application = Application::factory()->create();

    $response = $this->get(route('applications.show', $application));

    $response->assertRedirect(route('login'));
});
