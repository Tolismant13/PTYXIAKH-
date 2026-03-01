<?php

namespace RatingSystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

class RatingServiceProvider extends ServiceProvider
{
	public function boot()
    {
		  // Expiration date: 1 May 2026
        $expirationDate = Carbon::create(2026, 5, 1, 0, 0, 0);

        if (Carbon::now()->greaterThanOrEqualTo($expirationDate)) {
            return; // Stop loading the package after expiration
        }

        // Load package migrations
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        // Load package routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load package views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ratingsystem');

        // Register Blade components
        Blade::component('ratingsystem::components.rating-form', 'rating-form');
        Blade::component('ratingsystem::components.rating-list', 'rating-list');
    }

    public function register()
    {
        // If you had any helpers, load them here
        if (file_exists(__DIR__.'/helpers.php')) {
            require_once __DIR__.'/helpers.php';
        }
    }
}