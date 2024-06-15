<?php

use App\Models\Application;
use App\Models\User;

test('A user can delete their own application', function () {

    $user = User::factory()->create();

    $application = Application::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->delete(route('applications.destroy', $application));

    $response->assertRedirect(route('applications.index'));

    $this->assertDatabaseMissing('applications', [
        'id' => $application->id,
    ]);
});

test('Users cannot delete other users applications', function () {

    $user = User::factory()->create();

    $application = Application::factory()->create();

    $response = $this->actingAs($user)->delete(route('applications.destroy', $application));

    $response->assertForbidden();

    $this->assertDatabaseHas('applications', [
        'id' => $application->id,
    ]);
});

test('Guests cannot delete applications', function () {

    $application = Application::factory()->create();

    $response = $this->delete(route('applications.destroy', $application));

    $response->assertRedirect(route('login'));

    $this->assertDatabaseHas('applications', [
        'id' => $application->id,
    ]);

    $this->assertGuest();
});
