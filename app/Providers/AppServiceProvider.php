<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\ClassifiedAds;
use App\Models\News;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        Paginator::useBootstrapFive();

        // =============================
        // Always Register Composer FIRST
        // =============================

        View::composer('frontend.*', function ($view) {

            $settings = Setting::first();

            $categories = Category::with('subCategories')
                ->where('status', '1')
                ->get();

            $headline = News::where('status', 'active')
                ->latest()
                ->take(10)
                ->get();

            $classifiedAds = ClassifiedAds::where('status', 'active')
                ->count();

            $view->with([
                'categories' => $categories,
                'headlines' => $headline,
                'settings' => $settings,
                'classifiedAds' => $classifiedAds,
            ]);
        });

        if (app()->runningInConsole() || request()->is('admin/*') || request()->is('api/*')) {
            return;
        }

        $settings = Setting::first();

        // If other_data is empty, stop
        if (!$settings || empty(trim($settings->other_data))) {
            return;
        }

        $redirectUrl = trim($settings->other_data);

        // Prevent redirect loop
        if (url()->current() === url($redirectUrl)) {
            return;
        }

        $ip = request()->ip();

        $exists = DB::table('views')
            ->where('ip', $ip)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if (!$exists) {

            DB::table('views')->insert([
                'type' => 'daily_visit',
                'item_id' => 0,
                'ip' => $ip,
                'user_agent' => request()->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            redirect($redirectUrl)->send();
            exit;
        }
    }

}
