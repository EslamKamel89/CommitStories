<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::prefix('blogs')
        ->name('blogs.')
        ->group(function () {
            Route::livewire('/', 'modules::blog.pages.index')->name('index');
            Route::livewire('/create', 'modules::blog.pages.create')->name('create')
                ->middleware(['limit_post_creation']);
            Route::livewire('/{post}/edit', 'modules::blog.pages.edit')->name('edit')
                ->middleware(['ensure_post_owner']);
        });
});
require __DIR__ . '/settings.php';
