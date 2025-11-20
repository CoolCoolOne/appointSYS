<?php

namespace App\Providers;
use App\Models\Departament;
use App\Models\Unit;
use Illuminate\Support\Facades;
use Carbon\Carbon;
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
            $view->with(['items' => Departament::all(), 'subitems' => Unit::select('departament_id', 'name', 'id')->get()]);
        });


        Facades\View::composer('layouts.main', function ($view) {

            $timeFilterValue = Carbon::now()->addHour()->format('Y-m-d H:i:s');
            $futureMeetings = route('meetings.index', [
                'filter' => [
                    'after_date' => $timeFilterValue,
                ],
                'view_mode' => 'upcoming'
            ]);

            $pastMeetings = route('meetings.index', [
                'filter' => [
                    'before_date' => $timeFilterValue,
                ],
                'view_mode' => 'archive'
            ]);

            $view->with([
                'futureMeetings' => $futureMeetings,
                'pastMeetings' => $pastMeetings
            ]);
        });
    }
}
