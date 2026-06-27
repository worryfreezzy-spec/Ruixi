<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class AboutController
{
    public function __invoke(): View
    {
        $page = Page::query()
            ->where('slug', 'about')
            ->with(['sections'])
            ->firstOrFail();

        return view('about', [
            'page' => $page,
            'sections' => $page->sections->keyBy('type'),
        ]);
    }
}
