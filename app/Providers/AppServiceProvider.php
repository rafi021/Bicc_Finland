<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('helpers.php');
    }

    public function boot(): void
    {
        // if (!app()->runningInConsole() && \Illuminate\Support\Facades\Schema::hasTable('mosque_settings')) {
        //     \Illuminate\Support\Facades\View::share('setting', \App\Models\MosqueSetting::first() ?? new \App\Models\MosqueSetting());
        // }
    }
}
