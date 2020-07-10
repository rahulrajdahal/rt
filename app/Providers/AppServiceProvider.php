<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Projectyear;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $years = null;
        $settings = null;
        try {
            $years = Projectyear::where('hidden', false)->orderBy('year', 'desc')->get();
            $settings = Setting::first();
        } catch (\Exception $e) {
            \Log::error($e);
            $years = null;
            $settings = null;
        }
        View::share('projectYears', $years);
        View::share('settings', $settings);
    }
}
