<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class CeoController
{
    public function __invoke(): View
    {
        $page = Page::query()
            ->where('slug', 'ceo')
            ->with(['sections'])
            ->firstOrFail();

        return view('ceo', [
            'page' => $page,
            'sections' => $page->sections->keyBy('type'),
        ]);
    }
}
