<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HandleLogsController;
use App\Http\Controllers\RegenerateSecretKeyController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/applications');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('handle', [HandleLogsController::class, '__invoke'])
    ->name('handle-logs');

Route::group(['prefix' => 'applications', 'middleware' => ['auth']], function () {
    Route::get('/', [ApplicationController::class, 'index'])
        ->name('applications.index');

    Route::get('create', [ApplicationController::class, 'create'])
        ->name('applications.create');

    Route::post('/', [ApplicationController::class, 'store'])
        ->name('applications.store');

    Route::get('{application}', [ApplicationController::class, 'show'])
        ->name('applications.show');

    Route::get('{application}/edit', [ApplicationController::class, 'edit'])
        ->name('applications.edit');

    Route::put('{application}', [ApplicationController::class, 'update'])
        ->name('applications.update');

    Route::delete('{application}', [ApplicationController::class, 'destroy'])
        ->name('applications.destroy');

    Route::get('{application}/regenerate-secret-key', [RegenerateSecretKeyController::class, '__invoke'])
        ->name('applications.regenerate-secret-key');
});

require __DIR__ . '/auth.php';
