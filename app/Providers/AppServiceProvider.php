<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        //
        Paginator::useBootstrapFive();
        // Cache::flush()   clear entire cache
        // Cache::forget('key)   clear specific key
        // Chache::rememberForEver('key' , func) remembers for ever
        $topUsers = Cache::remember('topUsers', 60 * 2, function () {
            return User::withCount('ideas')->orderBy('ideas_count', 'ASC')->limit(5)->get();
        });
        View::share('topUsers' , $topUsers);
    }
}
