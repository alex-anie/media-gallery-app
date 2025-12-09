<?php

namespace App\Providers;

use App\Models\Media;
use App\Policies\MediaPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('update-media', [MediaPolicy::class, 'update']);
        Gate::define('delete-media', [MediaPolicy::class, 'delete']);
    }
}
