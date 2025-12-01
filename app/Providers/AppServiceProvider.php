<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\ClassifiedAds;
use App\Models\News;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        View::composer('frontend.*', function ($view) {
            $categories = Category::with('subCategories')
                ->where('status', '1')
                ->get();

            $headline = News::where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
            $settings = Setting::first();
            $classifiedAds = ClassifiedAds::where('status', 'active')
                ->count();
            $view->with([
                'categories' => $categories,
                'headlines'    => $headline,
                'settings' => $settings,
                'classifiedAds' => $classifiedAds,
            ]);
        });
    }
}
