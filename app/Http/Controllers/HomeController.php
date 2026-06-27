<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Banner;
use App\Models\Menu;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Partner;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $home = Page::query()
            ->where('slug', '/')
            ->with(['sections.items'])
            ->firstOrFail();

        $sections = $home->sections->keyBy('type');

        return view('home', [
            'home' => $home,
            'sections' => $sections,
            'settings' => SiteSetting::query()->first(),
            'headerMenu' => Menu::query()->where('location', 'header')->with('items.children')->first(),
            'footerMenu' => Menu::query()->where('location', 'footer')->with('items.children')->first(),
            'heroItems' => Banner::query()->orderBy('id')->get(),
            'featureItems' => $sections->get('feature_grid')?->items ?? collect(),
            'awards' => Award::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'partners' => Partner::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }
}
