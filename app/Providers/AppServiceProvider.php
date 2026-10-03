<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
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
        View::composer(['components.navbar', 'components.header', 'pages.*', 'layouts.app'], function ($view) {
            if (Schema::hasTable('categories')) {
                $navCategories = Category::whereNull('parent_id')
                    ->with(['children' => function ($q) {
                        $q->orderBy('sort_order');
                    }])
                    ->orderBy('sort_order')
                    ->get();

                $view->with('navCategories', $navCategories);
            }
        });
    }
}
