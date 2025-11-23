<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\News;
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
        View::composer('frontend.*', function ($view) {
            $categories = Category::with('subCategories')
                ->where('status', '1')
                ->get();

            $headline = News::where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
            $view->with([
                'categories' => $categories,
                'headlines'    => $headline,
            ]);
        });
    }
}
