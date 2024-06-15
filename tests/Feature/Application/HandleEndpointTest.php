<?php

use App\Models\Application;

test('the endpoint returns a 401 if the site id and secret key are incorrect', function () {
    $response = $this->postJson('/handle', [
        'site_id' => 23455543345,
        'site_secret_key' => 'bad-secret-key',
        'level' => 'error',
        'message' => 'This is a test message',
        'context' => ['key' => 'value'],
    ]);

    $response->assertStatus(401);

    $response->assertJson([
        'message' => 'Unauthorized',
    ]);
});

test('the endpoint returns a 400 if the site id and secret key are missing', function () {
    $response = $this->postJson('/handle', [
        'level' => 'error',
        'message' => 'This is a test message',
        'context' => ['key' => 'value'],
    ]);

    $response->assertStatus(400);

    $response->assertJson([
        'message' => 'Please ensure you are providing the site_id and site_secret_key.',
    ]);
});

test('the endpoint saves the log to the database', function () {
    $application = Application::factory()->create();

    $response = $this->postJson('/handle', [
        'site_id' => $application->id,
        'site_secret_key' => $application->secret_key,
        'level' => 'error',
        'message' => 'This is a test message',
        'context' => ['key' => 'value'],
    ]);

    $response->assertStatus(200);

    $response->assertJson([
        'message' => 'Log processed successfully.',
    ]);

    $this->assertDatabaseHas('logs', [
        'application_id' => $application->id,
        'level' => 'error',
        'message' => 'This is a test message',
    ]);
});
