<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::prefix('blogs')
        ->name('blogs.')
        ->group(function () {
            Route::livewire('/', 'modules::blog.pages.index')->name('index');
        });
});
require __DIR__ . '/settings.php';
