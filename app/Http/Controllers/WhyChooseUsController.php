<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class WhyChooseUsController
{
    public function __invoke(): View
    {
        $page = Page::query()
            ->where('slug', 'why-choose-us')
            ->with(['sections.items'])
            ->firstOrFail();

        $sections = $page->sections->keyBy('type');

        return view('why-choose-us.index', [
            'page' => $page,
            'sections' => $sections,
            'iconSection' => $sections->get('why_choose_icons'),
            'iconItems' => $sections->get('why_choose_icons')?->items ?? collect(),
            'advantageSection' => $sections->get('optimax_advantages'),
            'advantages' => $sections->get('optimax_advantages')?->items ?? collect(),
        ]);
    }
}
