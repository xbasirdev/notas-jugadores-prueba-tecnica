<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\PlayerNoteRepositoryInterface::class,
            \App\Repositories\EloquentPlayerNoteRepository::class
        );
        $this->app->bind(
            \App\Repositories\UserRepositoryInterface::class,
            \App\Repositories\EloquentUserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Livewire components explicitly in case auto-discovery isn't available
        Livewire::component('dashboard-notes', \App\Http\Livewire\DashboardNotes::class);
    }
}
