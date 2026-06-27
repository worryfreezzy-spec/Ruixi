<?php

namespace App\Http\Controllers;

use App\Models\ContactCta;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;

class CataractController
{
    public function index(): View
    {
        $category = ServiceCategory::query()
            ->where('slug', 'cataract')
            ->with(['services' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order')])
            ->firstOrFail();

        return view('cataract.index', [
            'category' => $category,
            'services' => $category->services,
            'contactCta' => ContactCta::query()->where('key', 'cataract')->first(),
        ]);
    }

    public function show(string $slug): View
    {
        $service = Service::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'sections.items'])
            ->firstOrFail();

        return view('cataract.show', [
            'service' => $service,
            'sections' => $service->sections->keyBy('type'),
            'contactCta' => ContactCta::query()->where('key', 'treatment_registration')->first(),
        ]);
    }
}
