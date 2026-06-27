<?php

namespace App\Http\Controllers;

use App\Models\ContactCta;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;

class ChildrenController
{
    public function index(): View
    {
        $category = ServiceCategory::query()
            ->where('slug', 'kids')
            ->with(['services' => fn ($query) => $query
                ->where('is_active', true)
                ->whereNotNull('thumbnail')
                ->orderBy('sort_order')])
            ->firstOrFail();

        return view('children.index', [
            'category' => $category,
            'children' => $category->services,
            'contactCta' => ContactCta::query()->where('key', 'children')->first(),
        ]);
    }

    public function show(string $slug): View
    {
        $child = Service::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->whereHas('category', fn ($query) => $query->where('slug', 'kids'))
            ->with(['category', 'sections.items'])
            ->firstOrFail();

        return view('children.show', [
            'child' => $child,
            'sections' => $child->sections->where('is_active', true)->sortBy('sort_order'),
            'contactCta' => ContactCta::query()->where('key', 'children')->first(),
        ]);
    }
}
