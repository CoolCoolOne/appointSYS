<?php

namespace App\Providers;
use App\Models\Departament;
use App\Models\Unit;
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
        Facades\View::composer('layouts.parts.menu_onelevel', function ($view) {
            $view->with(['items' => Departament::all(), 'subitems' => Unit::select('departament_id', 'name','id')->get()]);
        });
    }
}
