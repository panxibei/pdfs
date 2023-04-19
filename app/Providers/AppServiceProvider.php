<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// 自定义
use Illuminate\Support\Facades\Schema;

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
        // 自定义
        Schema::defaultStringLength(191);
    }
}
