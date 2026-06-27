<?php

namespace App\Http\Controllers;

use App\Models\ContactCta;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;

class EyeDiseaseController
{
    public function index(): View
    {
        $category = ServiceCategory::query()
            ->where('slug', 'eye-diseases')
            ->with(['services' => fn ($query) => $query
                ->where('is_active', true)
                ->whereNotNull('thumbnail')
                ->orderBy('sort_order')])
            ->firstOrFail();

        return view('eye-diseases.index', [
            'category' => $category,
            'diseases' => $category->services,
        ]);
    }

    public function show(string $slug): View
    {
        $disease = Service::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->whereHas('category', fn ($query) => $query->where('slug', 'eye-diseases'))
            ->with(['category', 'sections.items'])
            ->firstOrFail();

        return view('eye-diseases.show', [
            'disease' => $disease,
            'sections' => $disease->sections->where('is_active', true)->sortBy('sort_order'),
            'contactCta' => ContactCta::query()->where('key', 'eye_disease')->first(),
        ]);
    }
}
