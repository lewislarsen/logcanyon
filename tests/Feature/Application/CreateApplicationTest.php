<?php

use App\Models\User;

test('a new application can be created', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('applications.store'), [
        'label' => 'Test Application',
        'site_url' => 'https://test-application.com',
    ]);

    $application = $user->applications()->first();

    $response->assertRedirect(route('applications.show', $application));

    $this->assertDatabaseHas('applications', [
        'label' => 'Test Application',
        'site_url' => 'https://test-application.com',
    ]);
});

test('guests cannot create applications', function () {
    $response = $this->post(route('applications.store'), [
        'label' => 'Test Application',
        'site_url' => 'https://test-application.com',
    ]);

    $response->assertRedirect(route('login'));

    $this->assertDatabaseMissing('applications', [
        'label' => 'Test Application',
        'site_url' => 'https://test-application.com',
    ]);

    $this->assertGuest();
});

test('a site label is required', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('applications.store'), [
        'label' => '',
        'site_url' => 'https://test-application.com',
    ]);

    $response->assertSessionHasErrors('label');

    $this->assertDatabaseMissing('applications', [
        'site_url' => 'https://test-application.com',
    ]);
});

test('the applications create page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('applications.create'));

    $response->assertOk();
});

test('the applications create page cannot be rendered by guests', function () {

    $response = $this->get(route('applications.create'));

    $response->assertRedirect(route('login'));

    $this->assertGuest();
});
