<?php

use Illuminate\Support\Facades\Route;
use RatingSystem\Controllers\RatingController;


Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
});

Route::get('/ratings/average/{type}/{id}', [RatingController::class, 'average'])->name('ratings.average');