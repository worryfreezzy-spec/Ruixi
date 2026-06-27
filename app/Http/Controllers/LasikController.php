<?php

namespace App\Http\Controllers;

use App\Models\ContactCta;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;

class LasikController
{
    public function index(): View
    {
        $category = ServiceCategory::query()
            ->where('slug', 'laser-vision-correction')
            ->with(['services' => fn ($query) => $query
                ->where('is_active', true)
                ->whereNotNull('thumbnail')
                ->orderBy('sort_order')])
            ->firstOrFail();

        return view('lasik.index', [
            'category' => $category,
            'services' => $category->services,
            'contactCta' => ContactCta::query()->where('key', 'treatment_registration')->first(),
        ]);
    }

    public function show(string $slug): View
    {
        $service = Service::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->whereHas('category', fn ($query) => $query->where('slug', 'laser-vision-correction'))
            ->with(['category', 'sections.items'])
            ->firstOrFail();

        return view('lasik.show', [
            'service' => $service,
            'sections' => $service->sections->where('is_active', true)->sortBy('sort_order'),
            'contactCta' => ContactCta::query()->where('key', 'treatment_registration')->first(),
        ]);
    }
}
