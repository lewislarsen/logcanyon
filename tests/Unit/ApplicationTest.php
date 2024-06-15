<?php

use App\Models\Application;

test('it regenerates the secret key', function () {

    $application = Application::factory()->create([
        'secret_key' => 'old-secret-key',
    ]);

    $application->regenerateSecretKey();

    expect($application->secret_key)->not()->toBe('old-secret-key');
});
