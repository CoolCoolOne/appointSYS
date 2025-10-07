<?php

namespace App\Providers;
use App\Models\Resourse;
use Illuminate\Support\Facades;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer('layouts.parts.menu_onelevel', function($view) {
            $view->with(['items' => Resourse::all()]);
        });
    }
}
