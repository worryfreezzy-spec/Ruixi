<?php

namespace App\Http\Controllers;

use App\Models\ContactCta;
use App\Models\Page;
use Illuminate\Contracts\View\View;

class PlasticSurgeryController
{
    public function __invoke(): View
    {
        $page = Page::query()
            ->where('slug', 'plastic-surgery')
            ->where('is_active', true)
            ->with(['sections.items'])
            ->firstOrFail();

        $serviceSection = $page->sections
            ->where('type', 'plastic_services')
            ->where('is_active', true)
            ->sortBy('sort_order')
            ->first();

        return view('plastic-surgery.index', [
            'page' => $page,
            'serviceSection' => $serviceSection,
            'services' => $serviceSection?->items?->where('is_active', true)->sortBy('sort_order') ?? collect(),
            'contactCta' => ContactCta::query()->where('key', 'cataract')->first(),
        ]);
    }
}
