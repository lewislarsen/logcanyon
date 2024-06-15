<?php

use App\Models\Application;
use App\Models\User;

test('users can update their own application', function () {
    $user = User::factory()->create();

    $application = Application::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->put(route('applications.update', $application), [
        'label' => 'Updated Application',
        'site_url' => 'https://updated-application.com',
    ]);

    $response->assertRedirect(route('applications.show', $application));

    $this->assertDatabaseHas('applications', [
        'label' => 'Updated Application',
        'site_url' => 'https://updated-application.com',
    ]);
});

test('users cannot update other users applications', function () {
    $user = User::factory()->create();

    $application = Application::factory()->create();

    $response = $this->actingAs($user)->put(route('applications.update', $application), [
        'label' => 'Updated Application',
        'site_url' => 'https://updated-application.com',
    ]);

    $response->assertForbidden();

    $this->assertDatabaseMissing('applications', [
        'label' => 'Updated Application',
        'site_url' => 'https://updated-application.com',
    ]);
});

test('a site label is required', function () {
    $user = User::factory()->create();

    $application = Application::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->put(route('applications.update', $application), [
        'label' => '',
        'site_url' => 'https://updated-application.com',
    ]);

    $response->assertSessionHasErrors('label');

    $this->assertDatabaseMissing('applications', [
        'site_url' => 'https://updated-application.com',
    ]);
});

test('the applications edit page can be rendered', function () {
    $user = User::factory()->create();

    $application = Application::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->get(route('applications.edit', $application));

    $response->assertOk();
});

test('the applications edit page cannot be rendered by guests', function () {
    $application = Application::factory()->create();

    $response = $this->get(route('applications.edit', $application));

    $response->assertRedirect(route('login'));
});
