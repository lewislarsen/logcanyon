<?php

use App\Models\Application;
use App\Models\User;

test('a user can regenerate their own applications secret key', function () {
    $user = User::factory()->create();

    $application = Application::factory()->create([
        'user_id' => $user->id,
        'secret_key' => '1234567890',
    ]);

    $response = $this->actingAs($user)->get(route('applications.regenerate-secret-key', $application));
    $response->assertRedirect(route('applications.show', $application));
    $this->assertNotEquals($application->fresh()->secret_key, '123456789');
    $this->assertAuthenticatedAs($user);
});

test('a user cannot regenerate another users applications secret key', function () {
    $user = User::factory()->create();

    $application = Application::factory()->create([
        'user_id' => $user->id,
        'secret_key' => '1234567890',
    ]);

    $anotherUser = User::factory()->create();
    $response = $this->actingAs($anotherUser)->get(route('applications.regenerate-secret-key', $application));
    $response->assertForbidden();
    $this->assertEquals($application->secret_key, '1234567890');
    $this->assertAuthenticatedAs($anotherUser);
});

test('a guest cannot regenerate an applications secret key', function () {
    $application = Application::factory()->create();
    $response = $this->get(route('applications.regenerate-secret-key', $application));
    $response->assertRedirect(route('login'));
    $this->assertEquals($application->secret_key, $application->fresh()->secret_key);
    $this->assertGuest();
});
