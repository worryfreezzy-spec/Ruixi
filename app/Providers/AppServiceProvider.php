<?php

namespace App\Providers;

use App\Models\Award;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\PageSection;
use App\Models\SiteSetting;
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
        Schema::defaultStringLength(191);

        View::composer('frontend.layout', function ($view): void {
            $view->with([
                'settings' => SiteSetting::query()->first(),
                'headerMenu' => Menu::query()->where('location', 'header')->with('items.children')->first(),
                'footerMenu' => Menu::query()->where('location', 'footer')->with('items.children')->first(),
                'awards' => Award::query()->where('is_active', true)->orderBy('id')->get(),
                'partners' => Partner::query()->where('is_active', true)->orderBy('id')->get(),
                'awardSection' => PageSection::query()->where('type', 'award_grid')->whereHas('page', fn ($query) => $query->where('slug', '/'))->first(),
                'logoSection' => PageSection::query()->where('type', 'logo_grid')->whereHas('page', fn ($query) => $query->where('slug', '/'))->first(),
            ]);
        });
    }
}
